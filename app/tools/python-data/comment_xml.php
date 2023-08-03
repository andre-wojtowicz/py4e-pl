<?php

require_once('data/data_util.php');

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;

$sanity = array(
  'urllib' => 'Powinieneś użyć modułu urllib aby pobrać dane z adresu URL'
);

// A random code
$code = $USER->id+$LINK->id+$CONTEXT->id;

// Set the data URLs
$sample_url = dataUrl('comments_42.xml');
$actual_url = dataUrl('comments_'.$code.'.xml');

// Compute the sum data
$json = getJsonOrDie(dataUrl('comments_42.json'));
$sum_sample = sumCommentJson($json);

$json = getJsonOrDie(dataUrl('comments_'.$code.'.json'));
$sum = sumCommentJson($json);

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['sum'] != $sum ) {
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
<b>Wyodrębnianie danych z kodu XML</b>
<p>
W poniższym zadaniu napiszesz program w Pythonie podobny do
<a href="https://py4e.pl/code3/geoxml.py" target="_blank">https://py4e.pl/code3/geoxml.py</a>.

Program będzie prosił o podanie adresu URL, odczytywał przy pomocy <code>urllib</code> dane kodu XML z podanego adresu URL, przeparsuje dane,
wyodrębni liczbę komentarzy w kodu XML, a następnie obliczy ich sumę.
</p>
<b>Pliki z danymi</b>
<p>
Dostępne są dwa pliki. Pierwszy z nich to przykładowy plik, dla którego podano również wynikową sumę, a drugi plik to rzeczywiste dane, które musisz przetworzyć w ramach tego zadania:
<ul>
<li> dane przykładowe: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a>
- suma wynosi <?= $sum_sample ?>,</li>
<li> dane do zadania: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a>
- suma kończy się cyframi ...<?= sprintf('%02d', $sum%100); ?>.<br/></li>
</ul>
Nie musisz zapisywać tych plików w swoim katalogu roboczym, ponieważ Twój program odczyta dane bezpośrednio z podanego przez Ciebie adresu URL.
<b>Uwaga</b>: każdy kursant ma oddzielny plik danych do tego zadania, więc do analizy używaj tylko własnego pliku danych.
</p>
<b>Format danych</b>
<p>
Plik zawiera dane w formacie XML, które zawierają wiele imion i odpowiadających im liczby komentarzy. Poniżej znajduje się fragment danych:
<pre class="xml"><code>&lt;comment&gt;
  &lt;name&gt;Matthias&lt;/name&gt;
  &lt;count&gt;97&lt;/count&gt;
&lt;/comment&gt;</code></pre>
Musisz przejrzeć wszystkie znaczniki <code>&lt;comment&gt;</code> i odnaleźć w nich wartości <code>&lt;count&gt;</code>, tak aby obliczyć ich sumę.
Przykładowy kod pokazujący jak przeparsować kod XML dostępny jest w pliku <a href="http://www.py4e.com/code3/geoxml.py" target="_blank">geoxml.py</a>.
Zwróć jednak uwagę, że w naszych danych zagnieżdżanie elementów XML jest inne niż te, które zostało użyte w powyższym przykładowym kodzie, zatem musisz wprowadzić w kodzie pewne zmiany.
</p>
<p>
Aby uprościć nieco Twój kod, możesz użyć selektora XPath tak, aby przejrzeć całe drzewo XML dla dowolnego znacznika o nazwie <code>count</code>:
<pre class="python"><code>counts = tree.findall('.//count')</code></pre>
Zapoznaj się z dokumentacją <code>ElementTree</code> i poszukaj obsługiwanej składni XPath. Możesz także iść od góry kodu XML wgłąb do węzła <code>comments</code>, a następniekolejno przechodzić przez jego węzły potomne.
</p>
<p><b>Przykładowe uruchomienie programu</b></p>
<p>
Oto przykładowe uruchomienie programu z rozwiązaniem zadania:
<pre>
Podaj adres: http://py4e-data.dr-chuck.net/comments_42.xml
Pobieranie: http://py4e-data.dr-chuck.net/comments_42.xml
Pobrano 4189 znaków
Ile liczb: 50
Suma: 2553
</pre>
</p>
<?php httpsWarning($sample_url); ?>
<p><b>Rozwiązanie zadania</b></p>
<form method="post">
Wprowadź poniżej sumę z danych do zadania oraz kod Twojego programu, a następnie kliknij na przycisk "Wyślij rozwiązanie":<br/>
Suma (kończy się cyframi <?= sprintf('%02d', $sum%100); ?>): <input type="text" size="20" name="sum"><br/>
Kod Pythona:<br/>
<textarea rows="15" style="width: 90%; font-family: monospace" name="code"></textarea><br/>
<input style="margin-left: 10px;" type="submit" value="Wyślij rozwiązanie"><br/>
</form>
