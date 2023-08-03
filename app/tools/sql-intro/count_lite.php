<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$MAX_UPLOAD_FILE_SIZE = 1024*1024;

require_once "sql_util.php";


$answer = array(
"iupui.edu" => 536,
"umich.edu" => 491,
"indiana.edu" => 178,
"caret.cam.ac.uk" => 157,
"vt.edu" => 110
);

$oldgrade = $RESULT->grade;

if ( isset($_FILES['database']) ) {
    $fdes = $_FILES['database'];

    // Check to see if they left off the file
    if( $fdes['error'] == 4) {
        $_SESSION['error'] = 'Brak pliku; upewnij się, że wybrałeś plik przed wysłaniem rozwiązania';
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $fdes['size'] > $MAX_UPLOAD_FILE_SIZE ) {
        $_SESSION['error'] = "Wgrywany plik musi mieć rozmiar < ".$OUTPUT->displaySize($MAX_UPLOAD_FILE_SIZE);
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( ! endsWith($fdes['name'],'.sqlite') ) {
        $_SESSION['error'] = "Wgrywany plik musi mieć rozszerzenie .sqlite: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( ! isset($fdes['tmp_name']) ) {
        $_SESSION['error'] = "Nie odnaleziono pliku na serwerze: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( strlen($fdes['tmp_name']) < 1 ) {
        $_SESSION['error'] = "Nie odnaleziono tymczasowej nazwy: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $file = $fdes['tmp_name'];

    $fh = fopen($file,'r');
    $prefix = fread($fh, 100);
    fclose($fh);
    if ( ! startsWith($prefix,'SQLite format 3') ) {
        $_SESSION['error'] = "Wgrywany plik nie jest w formacie SQLite3: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $results = false;
    try {
        $db = new SQLite3($file, SQLITE3_OPEN_READONLY);
        $results = @$db->query('SELECT org, count FROM Counts 
            ORDER BY count DESC LIMIT 5');
    } catch(Exception $ex) {
        $_SESSION['error'] = "Błąd SQL: ".$ex->getMessage();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $results === false ) {
        $_SESSION['error'] = "Błąd zapytania SQL: ".$db->lastErrorMsg();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $good = 0;

    while ($row = $results->fetchArray()) {
        $row[0] = trim($row[0]);
        if ( !isset($answer[$row[0]]) ) continue;
        if ( $answer[$row[0]] != $row[1] ) continue;
        $good++;
    }

    if ( $good < 5 ) {
        $_SESSION['error'] = "Niepoprawne dane: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $gradetosend = 1.0;
    $scorestr = "Odpowiedź poprawna, wynik został zapisany.";
    if ( $dueDate->penalty > 0 ) {
        $gradetosend = $gradetosend * (1.0 - $dueDate->penalty);
        $scorestr = "Wynik efektywny = $gradetosend po ".$dueDate->penalty*100.0." procent kary za spóźnienie";
    }
    if ( $oldgrade > $gradetosend ) {
        $scorestr = "Nowy wynik $gradetosend jest mniejszy niż poprzedni wynik $oldgrade, więc poprzedni wynik zostaje zachowany";
        $gradetosend = $oldgrade;
    }

    // Use LTIX to send the grade back to the LMS.
    $debug_log = array();
    $retval = LTIX::gradeSend($gradetosend, false, $debug_log);
    $_SESSION['debug_log'] = $debug_log;

    if ( $retval === true ) {
        $_SESSION['success'] = $scorestr;
    } else if ( is_string($retval) ) {
        $_SESSION['error'] = "Wynik nie został wysłany: ".$retval;
    } else {
        echo("<pre>\n");
        var_dump($retval);
        echo("</pre>\n");
        die();
    }

    // Redirect to ourself
    header('Location: '.addSession('index.php'));
    return;
}

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
?>
<p>
<form name="myform" enctype="multipart/form-data" method="post" >
Aby otrzymać punkty za to zadanie, wykonaj poniższe instrukcje i prześlij poniżej plik z bazą SQLite3 (plik musi mieć rozszerzenie <code>.sqlite</code>):<br/>
<input name="database" type="file"> 
Wskazówka: największa liczba wysłanych e-maili przez organizację wynosi <?= $answer['iupui.edu'] ?>.<br/>
<input type="submit" value="Wyślij rozwiązanie">
<p>
Nie musisz eksportować ani konwertować bazy; po prostu wyślij utworzony przez Twój program plik <code>.sqlite</code>.
Przejrzyj przykładowy kod, tak aby zobaczyć w jaki sposób użyć funkcji <code>connect()</code>.
</p>
</form>
</p>
<h1>Zliczanie organizacji</h1>
<p>
Twoja aplikacja będzie odczytywała dane mailowe (plik <code>mbox.txt</code>) i zliczy ile wiadomości mailowych wysłała każda z 
organizacji (tzn. każda część domenowa adresu e-mail będzie traktowana jako organizacja). Dane będą przechowywane w bazie danych 
o poniższym schemacie:
<pre class="sql"><code>CREATE TABLE Counts
(
    org   TEXT,
    count INTEGER
);</code></pre>
Po uruchomieniu programu na pliku <code>mbox.txt</code>, jako rozwiązanie wgraj tutaj wynikową bazą danę SQLite3. 
</p>
<p>
Jeśli będziesz uruchamiać swój program kilka razy lub będziesz używać różnych plików wejściowych,
to pamiętaj aby za każdym razem wyczyścić swoją bazę danych.
<p>

Możesz rozpocząć prace nad rozwiązaniem zadania zaczynając od analizy i modyfikacji programu <a href="https://py4e.pl/code3/emaildb.py" target="_blank">
https://py4e.pl/code3/emaildb.py</a>.
</p>
<p>
Dane do tego zdania dostępne są w pliku <a href="https://py4e.pl/code3/mbox.txt" target="_blank">
https://py4e.pl/code3/mbox.txt</a>.
</p>
<p>
Przykładowy kod w pętli podczas odczytywania każdego rekordu używa instrukcji <code>UPDATE</code> i przekazuje wyniki do bazy danych. W związku z tym przetworzenie wszystkich danych może zająć nawet kilka minut. Metoda <code>commit()</code> powoduje, że nowe dane są zapisywane na dysku za każdym razem gdy zostanie wywołana ta metoda.
</p>
<p>
Program można znacznie przyspieszyć przenosząc poza pętlę operację <code>commit()</code>. W każdym programie bazodanowym istnieje równowaga między liczbą wykonywanych operacji zapisywania danych a troską o to by nie utracić wyników operacji, które nie zostały jeszcze zapisane.
</p>
