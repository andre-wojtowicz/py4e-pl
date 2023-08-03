<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

require_once "sql_util.php";

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;
$roster = makeRoster($code);
$shas = array();
foreach($roster as $i => $student) {
    $row = $student[0].$student[1].$student[2];
    $sha = strtoupper(bin2hex($row));
    // Dang SHAs that have only numbers
    $shas[] = $sha.'!';
}
$sorted = $shas;
sort($sorted);
$goodsha = $sorted[0];
$goodsha = str_replace('!','',$goodsha);

$oldgrade = $RESULT->grade;

if ( isset($_POST['sha1']) ) {
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

$url = LTIX::curPageUrlScript();
$data_url = str_replace('index.php','roster_data.php',$url);

// echo($goodsha);
if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
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
Twoja aplikacja ma za zadanie odczytać dane dotyczące listy uczestników kursów
zapisanej w pliku JSON, przeparsować plik, a następnie utworzyć
bazę danych SQLite zawierającą tabele <code>User</code>, <code>Course</code> i <code>Member</code> uzupełnione odpowiednimi danymi.
</p>
<p>
Możesz rozpocząć prace nad rozwiązaniem zadania zaczynając od analizy i modyfikacji programu
<a href="https://py4e.pl/code3/roster/roster.py" target="_blank">
http://py4e.pl/code3/roster/roster.py</a>. Kod jest niekompletny i musisz
go zmodyfikować w taki sposób, że będzie przechowywał kolumnę <code>role</code> w tabeli <code>Member</code>.
</p>
<p>
Każdy uczestnik kursu pracuje na osobnym pliku z danymi. Pobierz 
<a href="roster_data.php" target="_blank">ten plik</a> i zapisz go jako
<code>roster_data.json</code>. Przenieś ściągnięty plik do tego samego katalogu co program <code>roster.py</code>.
</p>
<p>
Gdy dokonasz niezbędnych zmian w swoim programie i będzie on w stanie poprawnie
odczytać dane JSON, uruchom poniższe zapytanie SQL:
<pre class="sql"><code>SELECT hex(User.name || Course.title || Member.role ) AS X
FROM   User JOIN Member JOIN Course 
       ON User.id = Member.user_id AND Member.course_id = Course.id
ORDER BY X;</code></pre>
Znajdź <b>pierwszy</b> wynikowy wiersz i jako odpowiedź wprowadź ciąg znaków, który wygląda mniej więcej tak: <code>53656C696E613333</code>.
</p>
