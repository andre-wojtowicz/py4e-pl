<?php
require_once "../config.php";

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
    'single_lite.php' => 'SQLITE - pojedyncza tabela (Users)',
    'count_lite.php' => 'SQLITE - zliczanie e-maili',
    'many_one_lite.php' => 'SQLITE - związek jeden-do-wielu (tabela Tracks)',
    'many_many_lite.php' => 'SQLITE - związek wiele-do-wielu (tabela Courses)'//,
    //'single_mysql.php' => 'Single Table MySQL (tabela Users)',
    //'many_many_mysql.php' => 'Many-to-Many MySQL (tabela Courses)',
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
    include($assn);
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

$OUTPUT->flashMessages();

$OUTPUT->welcomeUserCourse();

if ( $assn && isset($assignments[$assn]) ) {
    include($assn);
} else {
    if ( $USER->instructor ) {
        echo("<p>Skonfiguruj aktywność aby wybrać zadanie.</p>\n");
    } else {
        echo("<p>Aktywność wymaga skonfigurowania. Skontaktuj się ze swoim instruktorem.</p>\n");
    }
}
        

$OUTPUT->footer();

