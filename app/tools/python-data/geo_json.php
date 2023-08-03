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
<p>
W poniższym zadaniu napiszesz program podobny do
<a href="https://py4e.pl/code3/geojson.py" target="_blank">https://py4e.pl/code3/geojson.py</a>.
Program będzie prosił o podanie lokalizacji, połączy się z usługą sieciową zawierającą dane Google Maps, 
pobierze dane w formacie JSON, przeparsuje dane i ostatecznie wyświetli element <code>place_id</code>,
który jest tekstowym identyfikatorem danego miejsca.
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
Powyższe API przyjmuje taki sam parametr (adresy) jak API udostępniane przez Google.
API nie posiada również limitów wywołań, zatem możesz je testować tyle razy ile chcesz.
Jeśli wywołasz adres URL bez podanych parametrów, uzyskasz odpowiedź "No address...".
</p>
<p>
Aby wywołać API musisz podać parametr <code>key=42</code> oraz <code>address=</code> opisujący
poszukiwany adres. Oba parametry muszą być poprawnie zakodowane przy pomocy
funkcji <code>urllib.parse.urlencode()</code>, tak jak to pokazano w programie
<a href="https://py4e.pl/code3/geojson.py" target="_blank">https://py4e.pl/code3/geojson.py</a>.
</p>
<p>
Upewnij się, że Twój kod wykorzystuje podane wyżej adresy API. Uzyskasz <em>różne</em>
wyniki korzystając z adresów API <code>geojson</code> i <code>json</code>, więc upewnij się,
że korzystasz z tych samych adresów API co mechanizm sprawdzarkowy tego zadania.
<p>
<?php httpsWarning($api_url); ?>
<p><b>Dane testowe i przykładowe uruchomienie</b></p>
<p>
Możesz sprawdzić czy Twój program działa poprawnie podając lokalizację
 "<?= $sample_location ?>", której <code>place_id</code> wynosi <code><?= $sample_place ?></code>.<br/>
Oto przykładowe uruchomienie programu z rozwiązaniem zadania:
<pre>
Podaj lokalizację: <?= $sample_location . "\n" ?>
Pobieranie: http://...
Pobrano <?= $sample_count ?> znaków
place_id: <?= $sample_place ?>
</pre>
</p>
<p><b>Rozwiązanie zadania</b></p>
<p>
Uruchom swój program, tak aby uzyskać <code>place_id</code> dla poniższej lokalizacji:
<pre>
<?= $actual_location ?>
</pre>
Wskazówka: pierwsze siedem znaków <code>place_id</code> to <code><?= substr($actual_place,0,7) ?>...</code><br/><br/>

Upewnij się, że pobierasz dane przy pomocy adresu URL podanego powyżej, a nie
przy pomocy zwykłego API Google Maps. Twój program powinien działać również z płatnego API udostępnianego przez Google,
ale uzyskiwane <code>place_id</code> może być różne od tego, które jest wykorzystywane w tym zadaniu.<br/>

Upewnij się również, że wprowadziłeś poprawną nazwę (wielkość liter ma znaczenie), analogicznie do tego, co znajduje się w powyższym przykładzie.<br/><br/>
Umieść poniżej uzyskane <code>place_id</code> i kod swojego rozwiązania, a następnie kliknij na przycisk "Wyślij rozwiązanie":<br/>
</p>
<form method="post">
<code>place_id</code>: <input type="text" size="40" name="place_id"><br/>
Kod programu:<br/>
<textarea rows="15" style="width: 90%; font-family: monospace" name="code"></textarea><br/>
<input type="submit" value="Wyślij rozwiązanie"><br/>
</form>
