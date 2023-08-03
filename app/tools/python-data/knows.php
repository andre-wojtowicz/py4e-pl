<?php

require_once('data/data_util.php');

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;


// py4e-data.dr-chuck.net is 64 bit

if ( PHP_INT_SIZE == 8 ) {
    $GLOBAL_PYTHON_DATA_URL = "http://py4e-data.dr-chuck.net/";
} else {
    $GLOBAL_PYTHON_DATA_URL = false; // To serve locally
}

$sanity = array(
    'urllib' => 'Powinieneś użyć modułu urllib aby pobrać dane z adresu URL',
    'BeautifulSoup' => 'Powinieneś użyć biblioteki BeautifulSoup aby przeparsować HTML'
);

// Compute the stuff for the output
$sample_pages = 4;
$sample_pos = 2;
$actual_pages = 7;
$actual_pos = 17;

$code = 12345;
$sample_names = array();
$names = getShuffledNames($code);
$name = $names[$sample_pos];
$sample_names[] = $name;
for($p=0;$p<$sample_pages;$p++) {
    $code = array_search($name, $NAMES);
    $names = getShuffledNames($code);
    $name = $names[$sample_pos];
    $sample_last = $name;
    $sample_names[] = $name;
}

if ( isset($_SESSION['debug']) && is_string($_SESSION['debug']) ) {
    $code = array_search($_SESSION['debug'], $NAMES);
    $name = $_SESSION['debug'];
} else {
    $code = $USER->id+$LINK->id+$CONTEXT->id;
    $names = getShuffledNames($code);
    $name = $names[$actual_pos];
}
$actual_names = array();
$actual_names[] = $name;
for($p=0;$p<$actual_pages;$p++) {
    $code = array_search($name, $NAMES);
    $names = getShuffledNames($code);
    $name = $names[$actual_pos];
    $actual_last = $name;
    $actual_names[] = $name;
}

$oldgrade = $RESULT->grade;
if ( isset($_POST['name']) && isset($_POST['code']) ) {
    if ( $USER->instructor && strpos($_POST['name'],'42') === 0 ) {
        $pieces = explode(',',$_POST['name']);
        $_SESSION['success'] = "Tryb debugowania odblokowany";
        if ( count($pieces) == 2 ) {
            $_SESSION['debug'] = $pieces[1];
        } else {
            $_SESSION['debug'] = true;
        }
        header('Location: '.addSession('index.php'));
        return;
    }

    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['name'] != $actual_last ) {
        $_SESSION['error'] = "Podane przez Ciebie imię nie pasuje do oczekiwanego wyniku";
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

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
$sample_url = dataUrl('known_by_'.$sample_names[0].'.html');
$actual_url = dataUrl('known_by_'.$actual_names[0].'.html');
?>
<p>
<b>Przechodzenie po linkach przy pomocy BeautifulSoup</b>
</p>
<p>
W poniższym zadaniu napiszesz program, który poszerza możliwości programu
<a href="https://py4e.pl/code3/urllinks.py" target="_blank">https://py4e.pl/code3/urllinks.py</a>.
Program będzie używał modułu <code>urllib</code> do odczytania z poniższych plików kodu HTML, wyodrębni wartości <code>href</code> ze znaczników hiperłączy, przeskanuje dane w poszukiwaniu znacznika na określonej pozycji listy, przejdzie do kolejnej strony i powtórzy cały proces podaną liczbę razy, a na końcu wyświetli ostatnie znalezione imię.
</p>
<b>Pliki z danymi</b>
<p>
Dostępne są dwa pliki. Pierwszy z nich to przykładowy plik, dla którego podano również wynikowe imię, a drugi plik to rzeczywiste dane, które musisz przetworzyć w ramach tego zadania:
<ul>
<li> dane przykładowe: rozpocznij od
<a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a> <br/>
Pierwsze imię znajduje się w adresie URL między <code>known_by_</code> a <code>.html</code>. Pod wskazanym adresem URL znajdź na liście link na pozycji <b><?= $sample_pos+1 ?></b>. Przejdź dalej po tym linku. Powtórz cały proces <b><?= $sample_pages ?></b> razy. 
Odpowiedzią jest ostatnie odnalezione imię.
<br/>
Sekwencja imion:
<?php
    echo("<code>");
    foreach($sample_names as $name) {
        echo($name.' ');
    }
    echo("</code>");
    echo("<br/>\n");
?>
Ostatnie imię w sekwencji: <code><?= $sample_last ?></code><br/>
</li>
<li> dane do zadania: rozpocznij od <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a> <br/>
Pierwsze imię znajduje się w adresie URL między <code>known_by_</code> a <code>.html</code>. Pod wskazanym adresem URL znajdź na liście link na pozycji <b><?= $actual_pos+1 ?></b>. Przejdź dalej po tym linku. Powtórz cały proces <b><?= $actual_pages ?></b> razy.
Odpowiedzią jest ostatnie odnalezione imię.<br/>
Wskazówka: pierwszą literą imienia z ostatniej strony do przetworzenia jest: <?= substr($actual_last,0,1) ?><br/>
<?php
if ( isset($_SESSION['debug']) ) {
    echo("<pre>\n");
    echo("Debugowanie sekwencji imion: \n");
    foreach($actual_names as $name) {
        echo("  $name\n");
    }
    echo("</pre>\n");
}
?>
</li>
</ul>
<b>Strategia rozwiązania zadania</b>
<p>
Przetwarzane przez Ciebie strony internetowe będą dostosowywać odstępy między linkami i będą ukrywały zawartość strony po kilku sekundach, tak aby utrudnić wykonanie zadania osobom, które nie będą chciały napisać programu. Szczerze mówiąc zdajemy sobie sprawę z tego, że przy odrobinie wysiłku i cierpliwości utrudnienia te są do pokonania, ale nie o to chodzi w tym zadaniu. Celem tego zadania jest napisanie w Pythonie eleganckiego programu, który rozwiąże powyższy problem.
</p>
<p><b>Przykładowe uruchomienie programu</b>
<p>
Oto przykładowe uruchomienie programu z rozwiązaniem zadania:
<pre>
Podaj adres URL: <?= dataUrl('known_by_Fikret.html')."\n"; ?>
Podaj liczbę powtórzeń: 4
Podaj pozycję: 3
Pobieram: <?= dataUrl('known_by_Fikret.html')."\n"; ?>
Pobieram: <?= dataUrl('known_by_Montgomery.html')."\n"; ?>
Pobieram: <?= dataUrl('known_by_Mhairade.html')."\n"; ?>
Pobieram: <?= dataUrl('known_by_Butchi.html')."\n"; ?>
Pobieram: <?= dataUrl('known_by_Anayah.html')."\n"; ?>
</pre>
Rozwiązaniem zadania jest <code>Anayah</code>.
</p>
<?php httpsWarning($sample_url); ?>
<p><b>Rozwiązanie zadania</b>
<form method="post">
Umieść poniżej ostatnie pobrane imię oraz kod Twojego programu, a następnie kliknij na przycisk "Wyślij rozwiązanie":<br/>
Imię (zaczyna się na literę <?= substr($actual_last,0,1) ?>): <input type="text" size="20" name="name"><br/>
<?php
if ( $USER->instructor ) {
    echo("<b>Wskazówki dla instruktora:</b> Jeśli chcesz sprawdzić kod kursanta, wprowadź <code>42,Viki</code> z imieniem od którego kursant ma rozpocząć działanie.<br/>");
}
?>
Kod programu:<br/>
<textarea rows="15" style="width: 90%; font-family: monospace" name="code"></textarea><br/>
<input style="margin-left: 10px;" type="submit" value="Wyślij rozwiązanie"><br/>
</form>
