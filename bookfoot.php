<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

$pos_head_start = strpos($HTML,'<head');
$pos_head_start = strpos($HTML,'<',$pos_head_start+1);
$pos_head_end = strpos($HTML,'</head',$pos_head_start);
$pos_body = strpos($HTML,'<body',$pos_head_end);
$pos_body = strpos($HTML,'<',$pos_body+1);
$pos_end = strpos($HTML,'</body',$pos_body);
$head = substr($HTML, $pos_head_start, $pos_head_end-$pos_head_start);
$body = substr($HTML, $pos_body, $pos_end-$pos_body);
require_once "top.php";
require_once "nav.php";

function x_sel($file) {
    global $HTML_FILE;
    $retval = 'value="'.$file.'"';
    if ( strpos($HTML_FILE, $file) === 0 ) {
        $retval .= " selected";
    }
    return $retval;
}

?>
<script>
function onSelect() {
    console.log($('#chapters').val());
    window.location = $('#chapters').val();
}
</script>    
<div style="float:right">
<select id="chapters" onchange="onSelect();">
  <option <?= x_sel("A0-preface.php") ?>>Przedmowa</option>
  <option <?= x_sel("01-intro.php") ?>>Rozdział 1: Wstęp</option>
  <option <?= x_sel("02-variables.php") ?>>Rozdział 2: Zmienne, wyrażenia i instrukcje</option>
  <option <?= x_sel("03-conditional.php") ?>>Rozdział 3: Wykonanie warunkowe</option>
  <option <?= x_sel("04-functions.php") ?>>Rozdział 4: Funkcje</option>
  <option <?= x_sel("05-iterations.php") ?>>Rozdział 5: Pętle i iteracje</option>
  <option <?= x_sel("06-strings.php") ?>>Rozdział 6: Napisy</option>
  <option <?= x_sel("07-files.php") ?>>Rozdział 7: Pliki</option>
  <option <?= x_sel("08-lists.php") ?>>Rozdział 8: Listy</option>
  <option <?= x_sel("09-dictionaries.php") ?>>Rozdział 9: Słowniki</option>
  <option <?= x_sel("10-tuples.php") ?>>Rozdział 10: Krotki</option>
  <option <?= x_sel("11-regex.php") ?>>Rozdział 11: Wyrażenia regularne</option>
  <option <?= x_sel("12-network.php") ?>>Rozdział 12: Programy sieciowe</option>
  <option <?= x_sel("13-web.php") ?>>Rozdział 13: Korzystanie z usług sieciowych</option>
  <option <?= x_sel("14-objects.php") ?>>Rozdział 14: Programowanie obiektowe</option>
  <option <?= x_sel("15-database.php") ?>>Rozdział 15: Bazy danych i SQL</option>
  <option <?= x_sel("16-viz.php") ?>>Rozdział 16: Wizualizacja danych</option>
</select>
</div>

<div style="clear: right;margin-bottom: 20px;"></div>
<style>
.book-primary-btn {
	background: #f8e6b8;
	padding: 3px;
	background: -moz-linear-gradient(top, #f8e6b8 0, #f3d686 6%, #ebb62c 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #f8e6b8), color-stop(6%, #f3d686), color-stop(100%, #ebb62c));
	background: -webkit-linear-gradient(top, #f8e6b8 0, #f3d686 6%, #ebb62c 100%);
	background: -o-linear-gradient(top, #f8e6b8 0, #f3d686 6%, #ebb62c 100%);
	background: -ms-linear-gradient(top, #f8e6b8 0, #f3d686 6%, #ebb62c 100%);
	background: linear-gradient(to bottom, #f8e6b8 0, #f3d686 6%, #ebb62c 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8e6b8', endColorstr='#ebb62c', GradientType=0)
}
.book-primary-btn:hover {
	background: #f4f2ed;
	background: -moz-linear-gradient(top, #f4f2ed 0, #efdeb3 6%, #e8bb4a 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #f4f2ed), color-stop(6%, #efdeb3), color-stop(100%, #e8bb4a));
	background: -webkit-linear-gradient(top, #f4f2ed 0, #efdeb3 6%, #e8bb4a 100%);
	background: -o-linear-gradient(top, #f4f2ed 0, #efdeb3 6%, #e8bb4a 100%);
	background: -ms-linear-gradient(top, #f4f2ed 0, #efdeb3 6%, #e8bb4a 100%);
	background: linear-gradient(to bottom, #f4f2ed 0, #efdeb3 6%, #e8bb4a 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f4f2ed', endColorstr='#e8bb4a', GradientType=0)
}
</style>
<div style="float: right; border-left:0px; border-right:0px; border-bottom:0px; max-width:150px; border-top: 2px solid #f90; padding: 8px 0; margin-left: 20px; line-height: 11px;">
    <div style="text-align: center;">
        <img style="max-width: 150px;" src="https://py4e.pl/book-cover3d.png" />
    </div>
    <div style="text-align: center; margin-top: 3px;">
        <span style="color:#333333; font: normal 12px/17px Arial,Helvetica,sans-serif;">Kup książkę w wersji drukowanej:</span>
    </div>
    <div class="book-primary-btn" style="margin-top: 5px; padding: 3px; width: 100%; border-width: 1px 0;">
        <a rel="nofollow" href="https://amzn.to/3eNb3wp" target="_blank" style="text-decoration: none; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; margin: 0; padding: 0; width: 100%; font: normal 14px/17px Arial,Helvetica,sans-serif; color: #333; font-size: 12px; text-align: center; display: flex; justify-content: space-between;">
            <div style=""><img src="https://py4e.pl/book-amz.png" style="height: 20px;" /></div>
            <div style="align-self: center;">miękka oprawa</div>
            <div style="width: 20px"></div>
        </a>
    </div>
    <div class="book-primary-btn" style="margin-top: 5px; padding: 3px; width: 100%; border-width: 1px 0;">
        <a rel="nofollow" href="https://amzn.to/3QM0ZBc" target="_blank" style="text-decoration: none; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; margin: 0; padding: 0; width: 100%; font: normal 14px/17px Arial,Helvetica,sans-serif; color: #333; font-size: 12px; text-align: center; display: flex; justify-content: space-between;">
            <div style=""><img src="https://py4e.pl/book-amz.png" style="height: 20px;" /></div>
            <div style="align-self: center;">twarda oprawa</div>
            <div style="width: 20px"></div>
        </a>
    </div>
</div>

<?php
echo($body);
?>
<hr/>
<p>
Jeśli znajdziesz błąd w tej książce, wyślij poprawkę za pomocą
<a href="https://github.com/andre-wojtowicz/py4e-pl/tree/master/book3" target="_blank">GitHuba</a>.
</p>
<?php

$OUTPUT->footer();
