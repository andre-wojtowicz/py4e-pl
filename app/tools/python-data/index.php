<?php
require_once "../config.php";
require_once "data/data_util.php";
require_once "data/names.php";
require_once "data/locations.php";

use \Tsugi\Core\Settings;
use \Tsugi\Core\LTIX;
use \Tsugi\UI\SettingsForm;

$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;

if ( SettingsForm::handleSettingsPost() ) {
    header( 'Location: '.addSession('index.php') ) ;
    return;
}

// All the assignments we support
$assignments = array(
    'regex_sum.php' => 'Sumowanie przy użyciu wyrażeń regularnych',
    'http_headers.php' => 'Sprawdzanie nagłówków HTTP',
    'comment_html.php' => 'Sumowanie liczby komentarzy z HTMLa',
    'knows.php' => 'Przechodzenie po linkach na stronach internetowych.',
    'comment_xml.php' => 'Sumowanie liczby komentarzy z XMLa',
    'comment_json.php' => 'Sumowanie liczby komentarzy z JSONa',
    'geo_json.php' => 'Pobieranie danych geograficznych z JSONa przy pomocy API'
);

$oldsettings = Settings::linkGetAll();

$assn = Settings::linkGet('exercise');
$custom = LTIX::ltiCustomGet('exercise');
if ( $assn && isset($assignments[$assn]) ) {
    // Configured
} else if ( strlen($custom) > 0 && isset($assignments[$custom]) ) {
    Settings::linkSet('exercise', $custom);
    $assn = $custom;
}

// Get any due date information
$dueDate = SettingsForm::getDueDate();

// Let the assignment handle the POST
if ( count($_POST) > 0 && $assn && isset($assignments[$assn]) ) {
    require($assn);
    return;
}

$menu = false;
if ( $LAUNCH->link && $LAUNCH->user && $LAUNCH->user->instructor ) {
    $menu = new \Tsugi\UI\MenuSet();
    $menu->addLeft('Dane kursantów', 'grades.php');
    if ( $CFG->launchactivity ) {
        $menu->addRight(__('Uruchomienia'), 'analytics');
    }
    $menu->addRight(__('Konfiguracja'), '#', /* push */ false, SettingsForm::attr());
}

// View
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->topNav($menu);

// Settings dialog
SettingsForm::start();
SettingsForm::select("exercise", __('Wybierz zadanie'),$assignments);
SettingsForm::dueDate();
SettingsForm::done();
SettingsForm::end();

$OUTPUT->welcomeUserCourse();

$OUTPUT->flashMessages();

if ( $assn && isset($assignments[$assn]) ) {
    require($assn);
} else {
    if ( $USER->instructor ) {
        echo("<p>Skonfiguruj aktywność aby wybrać zadanie.</p>\n");
    } else {
        echo("<p>Aktywność wymaga skonfigurowania. Skontaktuj się ze swoim instruktorem.</p>\n");
    }
}
        

$OUTPUT->footer();

