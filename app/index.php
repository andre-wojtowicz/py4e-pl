<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<h1>Python dla wszystkich</h1>
<?php if ( isset($_SESSION['id']) ) { ?>
<p>
Witaj na kursie MOOC (Massive Open Online Course) "Python dla wszystkich".
Teraz, gdy jesteś już zalogowany, masz dostęp do dodatkowych funkcji związanych z kursem.
<ul class="list-group">
<li class="list-group-item">
W trakcie realizacji kolejnych <a href="lessons">lekcji</a> zauważysz dodatkowe linki dotyczące quizów i zadań programistycznych. Po rozwiązaniu zadań, Twoje wyniki zostaną zapisane na stronie.</li>
<li class="list-group-item">
Możesz śledzić swoje postępy w nauce za pomocą sekcji <a href="assignments">Zadania</a>. Dodatkowo po ukończeniu pewnych grup zadań uzyskasz <a href="badges">odznaki</a>, które możesz pobrać i umieścić na swojej stronie internetowej lub podlinkować ich adresy URL.</li>
<li class="list-group-item">
Jeśli prowadzisz zajęcia z Pythona i chcesz wykorzystać udostępnione tutaj materiały (licencja Creative Commons), to możesz <a href="materials.php">pobrać lub zamieścić link</a> do treści z tej strony, <a href="tsugi/cc/export.php">wyeksportować materiały</a> kursu jako IMS Common Cartridge® lub złożyć wniosek o <a href="tsugi/admin/key/index.php">klucz i sekret</a> IMS Learning Tools Interoperability® (LTI®), tak by móc uruchamiać quizy i zadania programistyczne ze swojego systemu LMS. <?php if ( !($CFG->providekeys) ) { echo _m("[Obecnie generowanie kluczy LTI jest wyłączone] "); } ?>
</li>
</ul>
<?php } else { ?>
<p>
Witaj na stronie, na której znajdują się materiały kursowe związane z <a href="book.php"><b>bezpłatną książką "Python dla wszystkich"</b></a>. Umieszczone tutaj materiały i zadania pomogą w uzyskaniu certyfikatu w ramach <a href="https://www.coursera.org/specializations/python" target="_blank">specjalizacji w serwisie Coursera "Python for Everybody"</a>, <a href="https://www.edx.org/bio/charles-severance" target="_blank">dwóch kursów tematycznych "Python for Everybody" na edX</a> lub <a href="https://www.futurelearn.com/courses/programming-for-everybody-python" target="_blank">dwóch kursów "Python for Everybody" na FutureLearn</a>.
</p>
<p>
Możesz korzystać z tej strony na wiele różnych sposobów:
<ul class="list-group">
<li class="list-group-item">
Możesz przeglądać filmy i materiały szkoleniowe umieszczone w sekcji <a href="lessons">Lekcje</a>. Wszystkie opracowane i umieszczone tutaj materiały są objęte licencją Creative Commons, więc możesz je pobrać lub podlinkować.</li>
<li class="list-group-item">
Jeśli <a href="tsugi/login.php">zalogujesz się</a> na tej stronie, dołączysz do bezpłatnego, globalnego, otwartego kursu internetowego. Będziesz mógł rozwiązywać quizy i zadania programistyczne, a wyniki będą zapisywały się w dzienniku ocen. Nagrodą za Twe trudy będą odznaki.</li>
<li class="list-group-item">
Na tej stronie poważnie traktujemy Twoją prywatność. Możesz zapoznać się z naszą <a href="privacy">Polityką prywatności</a>.
</li>
<li class="list-group-item">
Jeśli prowadzisz zajęcia z Pythona i chcesz wykorzystać udostępnione tutaj materiały (licencja Creative Commons), to możesz <a href="materials.php">pobrać lub zamieścić link</a> do treści z tej strony, <a href="tsugi/cc/export.php">wyeksportować materiały</a> kursu jako IMS Common Cartridge® lub złożyć wniosek o <a href="tsugi/admin/key/index.php">klucz i sekret</a> IMS Learning Tools Interoperability® (LTI®), tak by móc uruchamiać quizy i zadania programistyczne ze swojego systemu LMS. <?php if ( !($CFG->providekeys) ) { echo _m("[Obecnie generowanie kluczy LTI jest wyłączone] "); } ?>
</li>
<li class="list-group-item">
Kod tej witryny (w tym zawartość kursu, system sprawdzarkowy zadań programistycznych i slajdy) jest dostępny w serwisie <a href="https://github.com/andre-wojtowicz/py4e-pl" target="_blank">GitHub</a>. Oznacza to, że możesz stworzyć własną kopię tej strony, opublikować ją i zremiksować w dowolny sposób. Co więcej, możesz przetłumaczyć całą witrynę (kurs) na swój język i również ją opublikować. <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">Tutaj</a> znajduje się kilka wskazówek dotyczących tłumaczenia.
</li>
</ul>
<?php } ?>
Ta strona wykorzystuje framework <a href="https://www.tsugi.org" target="_blank">Tsugi</a> do integracji z systemami LMS i udostępnienia quizów i zadań programistycznych. Jeśli jesteś zainteresowany współpracą przy tworzeniu tego typu witryn na własne potrzeby, odwiedź stronę <a href="https://www.tsugi.org" target="_blank">tsugi.org</a>.
</p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
<?php $OUTPUT->footer();
