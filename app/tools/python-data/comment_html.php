<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;

$sanity = array(
  'urllib' => 'Powinieneś użyć modułu urllib aby pobrać dane z adresu URL',
  'BeautifulSoup' => 'Powinieneś użyć biblioteki BeautifulSoup aby przeparsować HTML'
);

// A random code
if ( isset($_SESSION['code_override']) ) {
    $code = $_SESSION['code_override'];
    $override = true;
} else {
    $code = $USER->id+$LINK->id+$CONTEXT->id;
    $override = false;
}

// Set the data URLs
$sample_url = dataUrl('comments_42.html');
$actual_url = dataUrl('comments_'.$code.'.html');

// Compute the sum data
$json = getJsonOrDie(dataUrl('comments_42.json'));
$sum_sample = sumCommentJson($json);

$json = getJsonOrDie(dataUrl('comments_'.$code.'.json'));
$sum = sumCommentJson($json);

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {

    if ( $USER->instructor && strpos($_POST['sum'],'code:') === 0 ) {
        $pieces = explode(':',$_POST['sum']);
        if ( count($pieces) == 2 && is_numeric($pieces[1]) ) {
            if ( $pieces[1] == 0 ) {
                unset($_SESSION['code_override']);
            } else {
                $_SESSION['code_override'] = $pieces[1]+0;
            }
            header('Location: '.addSession('index.php'));
        }
    }

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
$sample_url = dataUrl('comments_42.html');
$actual_url = dataUrl('comments_'.$code.'.html');
?>
<p>
<!--

If you are having problems with this assignment, give this code to the
instructor:  <?= $code ?>


-->
<p>
<b>Wyodrębnianie liczb z kodu HTML przy pomocy BeautifulSoup</b>
</p>
<p>
W poniższym zadaniu napiszesz program podobny do
<a href="https://py4e.pl/code3/urllink2.py" target="_blank">https://py4e.pl/code3/urllink2.py</a>.

Program będzie używał modułu <code>urllib</code> do odczytania kodu HTML z poniższych plików, przeparsuje dane,
wyodrębni liczby oraz obliczy ich sumę.
</p>
<b>Pliki z danymi</b>
<p>
Dostępne są dwa pliki. Pierwszy z nich to przykładowy plik, dla którego podana jest również wynikowa suma, a drugi plik to rzeczywiste dane, które musisz przetworzyć w ramach tego zadania:
<?php
if ( $override ) {
    echo('<p style="color:red">Znajdujesz się w trybie kursanta z kodem '.$code);
    echo(' o spodziewanej wynikowej sumie '.$sum.".</p>\n");
}
?>
<ul>
<li> dane przykładowe: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a>
- suma wynosi <?= $sum_sample ?>,</li>
<li> dane do zadania: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a>
- suma kończy się cyframi ...<?= $sum%100 ?>.<br/></li>
</ul>
Nie musisz zapisywać tych plików w swoim katalogu roboczym, ponieważ Twój program odczyta dane bezpośrednio z podanego przez Ciebie adresu URL.
<b>Uwaga</b>: każdy kursant ma oddzielny plik danych do tego zadania, więc do analizy używaj tylko własnego pliku danych.
</p>
<b>Format danych</b>
<p>
Plik HTML zawiera tabelę, której kolumny zawierają imiona oraz liczbę komentarzy. Możesz zignorować większość danych znajdujących się w pliku, z wyjątkiem wierszy takich jak:
<pre>
&lt;tr>&lt;td>Modu&lt;/td>&lt;td>&lt;span class="comments">90&lt;/span>&lt;/td>&lt;/tr>
&lt;tr>&lt;td>Kenzie&lt;/td>&lt;td>&lt;span class="comments">88&lt;/span>&lt;/td>&lt;/tr>
&lt;tr>&lt;td>Hubert&lt;/td>&lt;td>&lt;span class="comments">87&lt;/span>&lt;/td>&lt;/tr>
</pre>
Musisz znaleźć w pliku wszystkie znaczniki <code>&lt;span&gt;</code>, wyodrębnić z nich liczby i na końcu je zsumować.
<p>
Spójrz na udostępniony
<a href="http://py4e.pl/code3/urllink2.py" target="_blank">przykładowy kod</a>.
Pokazuje on jak znaleźć wszystkie znaczniki HTML danego typu, jak przejść w pętli po znacznikach i jak wyodrębnić z nich różne elementy.
<pre class="python"><code>...
# Pobierz wszystkie znaczniki hiperłączy
tags = soup('a')
for tag in tags:
    # Przejrzyj elementy związane ze znacznikiem
    print('TAG:', tag)
    print('URL:', tag.get('href', None))
    print('Contents:', tag.contents[0])
    print('Attrs:', tag.attrs)</code></pre>
Musisz dostosować kod w taki sposób, aby wyszukiwał znaczniki <code>&lt;span&gt;</code>, wyciągał z nich zawartość tekstową, którą przekonwertuje potem na liczby całkowite, a na końcu je wszystkie zsumuje.
</p>
<p><b>Przykładowe uruchomienie programu</b>
<p>
Oto przykładowe uruchomienie programu z rozwiązaniem zadania:
<pre>
Podaj adres URL: http://py4e-data.dr-chuck.net/comments_42.html
Ile liczb: 50
Suma: 2553
</pre>
</p>

<p><b>Rozwiązanie zadania</b>
<form method="post">
Wprowadź poniżej sumę z danych do zadania oraz kod Twojego programu, a następnie kliknij na przycisk "Wyślij rozwiązanie":<br/>
Suma: <input type="text" size="20" name="sum">
(powinna kończyć się cyframi ...<?= $sum%100 ?>)<br/>
<?php if ( $USER->instructor ) { ?>
<p style="color:green">Jeśli chcesz przejść w tryb danego kursanta, to poproś 
go o wyświetlenie kodu źródłowego tej strony i znalezienie w komentarzach 
wartości <code>code</code>. Następnie w polu dotyczącym sumy wprowadź <code>code:</code> i znalezioną
przez kursanta wartość, dzięki czemu przełączysz się na jego widok i zobaczysz 
przesłany przez niego kod.
</p>
<p style="color:green">
Wprowadź <code>code:0</code> aby powrócić do Twojego widoku.
</p>
<?php } ?>
Kod programu:<br/>
<textarea rows="15" style="width: 90%; font-family: monospace" name="code"></textarea><br/>
<input type="submit" value="Wyślij rozwiązanie"><br/>
</form>
