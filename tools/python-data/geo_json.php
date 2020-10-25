<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;
use \Tsugi\Util\Mersenne_Twister;

$sanity = array(
  'urllib' => 'Powinieneś użyć modułu urllib aby pobrać dane z adresu URL',
  'urlencode' => 'Powinieneś użyć modułu urlencode aby dodać parametry do adresu URL API',
  'json' => 'Powinieneś użyć modułu json aby przeparsować dane z adresu URL'
);

$api_url = dataUrl('json');

// Compute the stuff for the output
$code = 42;
$sample = load_geo(42, $api_url);
$sample_location = $sample[0];
$sample_place = $sample[1];
$sample_count = $sample[2];
$sample_url = $sample[3];

$code = $USER->id+$LINK->id+$CONTEXT->id;
$actual = load_geo($code, $api_url);
$actual_location = $actual[0];
$actual_place = $actual[1];
$actual_count = $actual[2];
$actual_url = $actual[3];

$oldgrade = $RESULT->grade;
if ( isset($_POST['place_id']) && isset($_POST['code']) ) {
    $RESULT->setJsonKeys( array(
        'code' => $_POST['code'],
        'place_id' => $_POST['place_id'],
        'actual_url' => $actual_url,
        'actual_place' => $actual_place
    ));

    if ( $_POST['place_id'] != $actual_place ) {
        $_SESSION['error'] = "Podane przez Ciebie place_id nie pasuje do oczekiwanego wyniku";
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
<b>Używanie API GeoJSON</b>
</p>
W poniższym zadaniu napiszesz program w Pythonie podobny do
<a href="https://py4e.pl/code3/geojson.py" target="_blank">https://py4e.pl/code3/geojson.py</a>.
Program będzie prosił o podanie lokalizacji, połączy się z usługą sieciową Google Maps, 
pobierze dane w formacie JSON, przeparsuje dane i wyświetli element <b>place_id</b>,
który jest tekstowym identyfikatorem unikalnie identyfikującym jakieś miejsce.
</p>
<p>
<b>Adresy API</b>
</p>
<p>
Aby wykonać to zadanie musisz użyć adresów API, które są statycznym podzbiorem
danych Google:
<pre>
<a href="<?= deHttps($api_url).'?' ?>" target="_blank"><?= deHttps($api_url) ?>?</a>
</pre>
API przyjmuje taki sam parametr (adresy) jak API Google.
API nie posiada również limitów wywołać, zatem możesz je testować tyle razy ile chcesz.
Jeśli wywołasz adres URL bez podanych parametrów, uzyskasz odpowiedź "No address...".
</p>
<p>
Aby wywołać API musisz podać parametr <b>key=</b> oraz <b>address=</b> opisujący
poszukiwany adres. Oba parametry muszą być poprawnie zakodowane przy pomocy
funkcji <b>urllib.parse.urlencode()</b>, tak jak to pokazano w programie
<a href="https://py4e.pl/code3/geojson.py" target="_blank">https://py4e.pl/code3/geojson.py</a>.
</p>
<p>
Upewnij się, że Twój kod wykorzystuje podane wyżej adresy API. Uzyskasz <em>różne</em>
wyniki korzystając z adresów API <b>geojson</b> i <b>json</b>, więc upewnij się,
że korzystasz z tych samych adresów API co mechanizm sprawdzarkowy tego zadania.
<p>
<?php httpsWarning($api_url); ?>
<p><b>Dane testowe / Przykładowe uruchomienie</b></p>
<p>
Możesz sprawdzić czy Twój program działa poprawnie podając lokalizację
 "<?= $sample_location ?>", której <b>place_id</b> wynosi "<?= $sample_place ?>".
<pre>
Podaj lokalizację: <?= $sample_location . "\n" ?>
Pobieranie: http://...
Pobrano <?= $sample_count ?> znaków
place_id: <?= $sample_place ?>
</pre>
</p>
<p><b>Rozwiązanie zadania</b></p>
<p>
Uruchom swój program aby uzyskać <b>place_id</b> dla poniższej lokalizacji:
<pre>
<?= $actual_location ?>
</pre>
Upewnij się, że wprowadziłeś nazwę i wielkość liter dokładnie takie same jak powyżej.
Umieść <b>place_id</b> i kod rozwiązania poniżej.<br>
Wskazówka: Pierwsze siedem znaków <b>place_id</b>
to "<?= substr($actual_place,0,7) ?> ..."<br/>
</p>
<p>
Upewnij się, że pobierasz dane przy pomocy adresu URL podanego powyżej, a nie
przy pomocy zwykłego Google API. Twój program powinien działać również z Google API,
ale uzyskiwane <b>place_id</b> może być różne od tego, które jest wykorzystywane w tym zadaniu.
</p>
<form method="post">
place_id: <input type="text" size="40" name="place_id">
<input type="submit" value="Wyślij rozwiązanie"><br/>
Kod Pythona:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
