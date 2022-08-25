<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

require_once "names.php";

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;
$MT = new Mersenne_Twister($code);
$my_names = array();
$my_age = array();
$howmany = $MT->getNext(4,6);
for($i=0; $i < $howmany; $i ++ ) {
    $name = $names[$MT->getNext(0,count($names)-1)];
    $age = $MT->getNext(13,40);
    $sha = strtoupper(bin2hex($name.$age));
    // http://stackoverflow.com/questions/4100488/a-numeric-string-as-array-key-in-php
    $database[$sha.'!'] = array($sha,$name,$age);
}
$sorted = $database;
ksort($sorted);
reset($sorted);
$row = reset($sorted);
$goodsha = $row[0];
$oldgrade = $RESULT->grade;
// die($goodsha);

if ( isset($_POST['sha1']) ) {
    if ( $_POST['sha1'] == '42' ) {
        $_SESSION['debug'] = '42';
    }
    if ( $_POST['sha1'] != $goodsha ) {
        $_SESSION['error'] = "Podany przez Ciebie kod nie pasuje do oczekiwanego wyniku";
        header('Location: '.addSession('index.php'));
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

// echo($goodsha);
if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
if ( isset($_SESSION['debug']) ) {
    echo("<pre>\n");
    echo("Code=$code\n");
    echo("Howmany=$howmany\n");
    var_dump($sorted);
    echo("</pre>\n");
    unset($_SESSION['debug']);
}
?>
<p>
<form method="post">
Aby otrzymać punkty za to zadanie, wykonaj poniższe instrukcje, a następnie wprowadź poniżej uzyskany kod:<br/>
<input type="text" size="80" name="sha1">
<input type="submit" value="Wyślij rozwiązanie">
</form>
(wskazówka: kod zaczyna się od <?= substr($goodsha,0,3) ?>...)<br/>
</p>
<h1>Instrukcje</h1>
<p>
Jeśli nie masz jeszcze zainstalowanej aplikacji SQLite Browser, to możesz ją pobrać ze strony
<a href="https://sqlitebrowser.org/" target="_blank">
https://sqlitebrowser.org/</a>.</p>
<p>
Następnie utwórz bazę danych SQLite (lub użyj jakiejś istniejącej bazy) i utwórz
w niej tabelę o nazwie <code>Ages</code>:
</p>
<pre class="sql"><code>CREATE TABLE Ages
( 
   name VARCHAR(128), 
   age  INTEGER
);</code></pre>
<p>
Następnie upewnij się, że tabela jest pusta, tj. usuń poprzednio wstawione
wiersze, a następnie umieść w tabeli tylko i wyłącznie poniższe wiersze:
<pre class="sql"><code><?php
echo("DELETE FROM Ages;\n");
foreach($database as $row) {
   echo("INSERT INTO Ages (name, age) VALUES ('".$row[1]."', ".$row[2].");\n");
}
?></code></pre>
Po wstawieniu do tabeli powyższych wierszy, uruchom poniższe polecenie SQL:
<pre class="sql">SELECT hex(name || age) AS X 
FROM   Ages
ORDER BY X;</code></pre>
Znajdź <b>pierwszy</b> wynikowy wiersz i jako odpowiedź do zadania wprowadź ciąg
znaków, który wygląda mniej więcej tak: <code>53656C696E613333</code>.
</p>
<p>
<b>Uwaga:</b> Zadanie musi być wykonane przy użyciu SQLite. W szczególności powyższe polecenie
<code>SELECT</code> może nie działać na innych silnikach bazodanowych, więc nie
korzystaj w tym zadaniu z np. MySQL lub Oracle.
</p>
