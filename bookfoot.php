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
