<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

$sanity = array(
  're.findall' => 'Powinieneś użyć re.findall() aby wyodrębnić liczby'
);

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;

$sample_url = dataUrl('regex_sum_42.txt');
$actual_url = dataUrl('regex_sum_'.$code.'.txt');

$sample_data = Net::doGet($sample_url);
$sample_count = strlen($sample_data);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$sample_url");
}

$actual_data = Net::doGet($actual_url);
$actual_count = strlen($actual_data);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$actual_url");
}

$actual_matches = array();
preg_match_all('/[0-9]+/',$actual_data,$actual_matches);
$actual_count = count($actual_matches[0]);
$actual_sum = 0;
foreach($actual_matches[0] as $match ) {
    $actual_sum = $actual_sum + $match;
}

$sample_matches = array();
preg_match_all('/[0-9]+/',$sample_data,$sample_matches);
$sample_count = count($sample_matches[0]);
$sample_sum = 0;
foreach($sample_matches[0] as $match ) {
    $sample_sum = $sample_sum + $match;
}

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['sum'] != $actual_sum ) {
        $_SESSION['error'] = "Obliczona przez Ciebie suma nie pasuje do oczekiwanego wyniku";
        header('Location: '.addSession('index.php'));
        return;
    }

    $val = validate($sanity, $_POST['code']);
    if ( is_string($val) ) {
        $_SESSION['error'] = $val;
        header('Location: '.addSession('index.php'));
        return;
    }

    LTIX::gradeSendDueDate(1.0, $oldgrade, $dueDate);
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
?>
<p>
<b>Szukanie liczb w stogu siana</b>
<p>
W tym zadaniu odczytasz i przeanalizujesz plik zawierający tekst i liczby. Musisz wyodrębnić wszystkie liczby występujące w pliku i obliczyć ich sumę.
</p>
<b>Pliki danych</b>
<p>
Dostępne są dwa pliki. Pierwszy z nich to przykładowy plik, dla którego dostępna jest również wynikowa suma, natomiast drugi plik to rzeczywiste dane, które musisz przetworzyć w ramach zadania.
<ul>
<li> Dane przykładowe: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a> 
(Występuje tam <?= $sample_count ?> liczb, których suma wynosi <?= $sample_sum ?>) </li>
<li> Dane do zadania: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a> 
(Występuje tam <?= $actual_count ?> liczb, których suma kończy się cyframi <?= $actual_sum%1000 ?>)<br/> </li>
</ul>
Linki z danymi otwierają się w nowym oknie. Pamiętaj aby zapisać plik w tym samym katalogu, w którym będziesz pisać program.
<b>Uwaga</b>: każdy kursant ma oddzielny plik danych do zadania, więc do analizy używaj tylko własnego pliku danych.
</p>
<b>Format danych</b>
<p>
Plik zawiera pierwsze akapity angielskiej wersji podręcznika, z wyjątkiem tego, że w całym tekście wstawiane są losowe liczby. Oto fragment pliku:
<pre>
Why should you learn to write programs? 7746
12 1929 8827
Writing programs (or programming) is a very creative 
7 and rewarding activity.  You can write programs for 
many reasons, ranging from making your living to solving
8837 a difficult data analysis problem to having fun to helping 128
someone else solve a problem.  This book assumes that 
everyone needs to know how to program ...
</pre>
Suma dla powyższego tekstu wynosi <b>27486</b>.
Liczby mogą pojawić się w dowolnym miejscu wiersza. W każdym wierszu liczby mogą wystąpić dowolną ilość razy (włączając w to brak wystąpień).
</p>
<b>Przetwarzanie danych</b>
<p>
Podstawowy szkic rozwiązania tego problemu to: odczytanie pliku, wyszukanie liczb całkowitych za pomocą funkcji <code>re.findall()</code> i wyrażenia regularnego <code>[0-9]+</code>, a następnie przekonwertowanie wyodrębnionych ciągów znaków na liczby całkowite i ich zsumowanie.
</p>
<p>
<?php httpsWarning($sample_url); ?>
<b>Rozwiązanie zadania</b>
<form method="post">
Wprowadź poniżej sumę z danych do zadania oraz kod programu:<br/>
Suma: <input type="text" size="20" name="sum"> (kończy się cyframi <?= $actual_sum%1000 ?>)
<input type="submit" value="Wyślij rozwiązanie"><br/>
Kod programu:<br/>
<textarea rows="20" style="width: 90%; font-family: monospace" name="code"></textarea><br/>
</form>
</p>
<b>Opcjonalnie: po prostu dla zabawy</b>
<p>
Istnieje wiele różnych sposobów rozwiązania tego problemu. Chociaż generalnie nie zalecamy pisania możliwie najbardziej zwartego kodu, dla niektórych osób może to być ciekawe ćwiczenie. Oto schemat dwuwierszowej wersji rozwiązania tego zadania, używająca listy składanej:
<pre class="python"><code>import re
print( sum( [ ****** *** * in **********('[0-9]+',**************************.read()) ] ) )</code></pre>
Dopóki nie wykonasz zadania, nie trać zbyt dużo czasu na szukanie najkrótszego rozwiązania. Listy składane zostały omówione w rozdziale 10, a metoda <code>read()</code> została omówiona w rozdziale 7.
</p>
