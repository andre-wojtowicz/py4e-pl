<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

function mapdown($input) {
    return preg_replace('/[^a-z0-9]/i','',strtolower($input));
}

// Compute the stuff for the output
$getUrl = 'http://data.pr4e.org/intro-short.txt';

$data = Net::doGet($getUrl);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$getUrl");
}
$headers = Net::parseHeaders();

$fields = array(
    'Last-Modified',
    'ETag',
    'Content-Length',
    'Cache-Control',
    'Content-Type'
);

$oldgrade = $RESULT->grade;
// If we have a POST, pass to the GET
if ( count($_POST) > 0 ) {
    $_SESSION['postdata'] = $_POST;

    $count = 0;
    $good = 0;
    foreach($headers as $key => $val ) {
        if ( ! in_array($key,$fields) ) continue;
        $postkey = mapdown($key);
        $count++;
        if ( isset($_POST[$postkey])&& mapdown($_POST[$postkey]) == mapdown($val) ) {
            $good++;
        }
    } 
    if ( $count == 0 ) {
        die("Nie odnaleziono odpowiednich pól");
    }

    $gradetosend = (1.0 * $good) / $count;
    LTIX::gradeSendDueDate($gradetosend, $oldgrade, $dueDate);

    header('Location: '.addSession('index.php'));
    return;
}

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}

$postdata = isset($_SESSION['postdata']) ? $_SESSION['postdata'] : array();
unset($_SESSION['postdata']);

?>
<p>
<b>Poznajemy protokół HTTP</b>
</p>
<p>
W poniższym zadaniu musisz pobrać za pomocą protokołu HTTP poniższy plik w taki sposób, by móc sprawdzić nagłówki odpowiedzi HTTP:
<ul>
<li><a href="<?= $getUrl ?>" target="_blank"><?= $getUrl ?></a></li>
</ul>
</p>
<p>
Zmodyfikuj program <a href="<?= $CFG->apphome ?>/code3/socket1.py" target="_blank">socket1.py</a> tak, aby pobrać powyższy adres URL i wypisać nagłówki oraz dane. Pamiętaj aby zmienić kod programu tak, aby pobrał powyższy adres URL - wartości nagłówków są różne dla każdego adresu URL.
</p>
<p>
W każdym z poniższych pól wprowadź wartość odpowiadającego mu nagłówka, a następnie naciśnij przycisk "Wyślij rozwiązanie":
<form method="post">
<?php
    $count = 0;
    foreach($headers as $key => $val ) {
        if ( ! in_array($key,$fields) ) continue;
        $postkey = mapdown($key);
        $count++;
        echo(htmlentities($key).':<br/>');
        echo('<input type="text" size="60" name="'.$postkey.'" ');
        if ( isset($postdata[$postkey]) ) {
            echo('value="'.htmlentities($postdata[$postkey]).'" /> ');
            if ( mapdown($postdata[$postkey]) == mapdown($val) ) {
                echo('<i class="fa fa-check text-success"></i>');
            } else {
                echo('<i class="fa fa-times text-danger"></i>');
            }
        } else {
            echo("/> ");
        }
        echo("<br/>\n");
    } 
?>
<input style="margin-top: 10px;" type="submit" value="Wyślij rozwiązanie">
</form>
</p>
<?php
if ( $USER->instructor ) {
echo("\n<hr/>");
echo("\n<b>Wskazówki dla instruktora:</b><br>\n");
echo("\n<pre>\n");
echo("Uzyskane informacje:\n");
print_r($headers);
echo("\n");
echo($data);
echo("\n</pre>\n");
}
