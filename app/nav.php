<?php
$OUTPUT->bodyStart();
$R = $CFG->apphome . '/';
$T = $CFG->wwwroot . '/';
$adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
$set->addLeft('Przygotowanie', $R.'install');
$set->addLeft('Lekcje', $R.'lessons');
if ( isset($_SESSION['id']) ) {
    $set->addLeft('Zadania', $R.'assignments');
    // $set->addLeft('Discuss', $R.'group');
    // If both are set we go to discuss.php
    // if ( isset($CFG->disqushost) ) $set->addLeft('Discuss', $T.'discuss');
    // else if ( isset($CFG->disquschannel) ) $set->addLeft('Discuss', $CFG->disquschannel);
} else {
    $set->addLeft('Materiały', $R.'materials');
}

if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    $submenu->addLink('Profil', $R.'profile');
    if ( isset($CFG->google_map_api_key) ) {
        $submenu->addLink('Mapa', $R.'map');
    }

    $submenu->addLink('Odznaki', $R.'badges');
    $submenu->addLink('Materiały', $R.'materials');
    if ( $CFG->providekeys ) {
        $submenu->addLink('Integracja z LMS', $T . 'settings');
    }
    if ( isset($CFG->google_classroom_secret) ) {
        $submenu->addLink('Google Classroom', $T.'gclass/login');
    }
    $submenu->addLink('Oceń ten kurs', 'https://www.class-central.com/mooc/7363/python-for-everybody');
    $submenu->addLink('Polityka prywatności', $R.'privacy');
    if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
        $submenu->addLink('Darmowe aplikacje Tsugi', 'https://www.tsugicloud.org');
        $submenu->addLink('Zarządzaj stroną', $T . 'admin/');
    }
    $submenu->addLink('Wyloguj', $R.'logout');

    if ( isset($_SESSION['avatar']) ) {
        $set->addRight('<img src="'.$_SESSION['avatar'].'" style="height: 2em;"/>', $submenu);
        // htmlentities($_SESSION['displayname']), $submenu);
    } else {
        $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
    }
} else {
    $set->addRight('Logowanie', $R.'login');
}

$imenu = new \Tsugi\UI\Menu();

$imenu->addLink('Strona domowa', 'https://www.dr-chuck.com');
$imenu->addLink('Dyżury', 'https://www.dr-chuck.com/office/');
$set->addRight('Książka', $R . 'book');
$set->addRight('Instruktor', $imenu);

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
