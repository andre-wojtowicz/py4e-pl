<?php include("top.php");?>
<?php include("nav.php");?>
<div id="iframe-dialog" title="Read Only Dialog" style="display: none;">
   <iframe name="iframe-frame" style="height:600px" id="iframe-frame"
    src="<?= $OUTPUT->getSpinnerUrl() ?>"></iframe>
</div>
<!-- <div style="float: right; margin: 5px;"/><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=drchu02-20&marketplace=amazon&region=US&placement=1530051126&asins=1530051126&linkId=2ea6c883c6cf11f29568856139bad34b&show_border=true&link_opens_in_new_window=true"></iframe></div> -->
<h2>Materiały – otwarte zasoby edukacyjne</h2>
<p>
Możesz używać/ponownie używać/remiksować/zapisać materiały z tej witryny we własnych kursach. Prawie cały materiał umieszczony na tej stronie internetowej jest objęty licencją Creative Commons Uznanie autorstwa. Poniżej znajdują się linki do treści do pobrania, a także linki do innych materiałów z tego kursu.
</p>
<ul>
    <li>Wykłady wideo
    <ul>
    <li><a href="https://www.youtube.com/playlist?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank">YouTube</a></li>
    <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-video/id1214664324" target="_blank">iTunes</a></li>
    <li><a href="https://amzn.to/2mFrCuh" target="_blank">Amazon Prime</a></li>
    </ul>
    </li>
    <li>Wykłady audio
    <ul>
    <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-audio-py4e/id1214665693" target="_blank">iTunes</a></li>
    <li><a href="https://play.google.com/music/listen?u=0#/ps/Ijgj3aofh6m73rps4wtdk6djhv4" target="_blank">Google Play</a></li>
    </ul>
    </li>
    <li>
        <a href="lectures3/" target="_blank">Slajdy wykładowe i konspekty zajęć</a>
    </li>
    <li>
        <a href="code3.zip" target="_blank">Kod przykładowych programów ZIP</a>
        (<a href="code3/" target="_blank">poszczególne pliki</a>)
    </li>
    <li>
        <a href="book.php">Darmowy podręcznik</a>
    </li>
    <li>
        Cała zawartość kursu oraz system sprawdzarkowy zadań programistycznych jest dostępny na
        <a href="https://github.com/andre-wojtowicz/py4e-pl" target="_blank">
        GitHubie</a> na licencji Creative Commons lub Apache 2.0.
    </li>
</ul>
<p>
Jeśli zamierzasz przetłumaczyć tę książkę lub materiały online na inny język, 
to na repozytorium GitHuba znajdują się <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
instrukcje dotyczące tego jak zabrać się za tłumaczenie</a>.
Jeśli zaczynasz tłumaczenie, skontaktuj się z autorem aby skoordynować działania.
</p>
<h2>Używanie tego kursu w Twoim systemie LMS</h2>
<p>Ta strona wykorzystuje framework <a href="https://www.tsugi.org" target="_blank">Tsugi</a> do integracji z systemami typu Learning Management System i udostępnienia quizów i zadań programistycznych. Dzięki temu kurs można łatwo zintegrować z systemami LMS
takimi jak <a href="https://www.sakaiproject.org/" target=_blank">Sakai</a>, Moodle, Canvas, Desire2Learn, Blackboard
lub podobnymi.
</p>
<ul>
<li>
<p>
<?php if ( !($CFG->providekeys) ) { echo _m("[Obecnie generowanie kluczy LTI jest wyłączone] "); } ?>
Jeśli Twój LMS wspiera
<a href="https://www.imsglobal.org/activity/learning-tools-interoperability" target="_blank">
IMS Learning Tools Interoperabilty®</a> w wersji 1.x, to możesz się zalogować
i poprosić o dostęp do narzędzi umieszczonych na tej stronie. Upewnij się
czy potrzebujesz klucza LTI 1.x. Po otrzymaniu klucza otrzymasz instrukcje, jak używać tych poświadczeń.
</p>
</li>
<li>
<p>
<?php if ( !($CFG->providekeys) ) { echo _m("[Obecnie generowanie kluczy LTI jest wyłączone] "); } ?>
<a href="#" title="Pobierz materiały kursu"
  onclick="showModalIframeUrl(this.title, 'iframe-dialog', 'iframe-frame', 'tsugi/cc/select', _TSUGI.spinnerUrl, true); return false;" >
  Pobierz materiały kursu
  </a> jako
<a href="https://www.imsglobal.org/cc/index.html" target="_blank">
IMS Common Cartridge®</a>, tak aby zaimportować je do systemu LMS takiego jak Sakai, Moodle, Canvas,
Desire2Learn, Blackboard lub podobnego.
Po jego załadowaniu będziesz potrzebować klucza i sekretu LTI, tak abyśmy mogli
dostarczać Ci narzędzia oparte na LTI.
</p>
</li>
<li>
<p>
<?php if ( !($CFG->providekeys) ) { echo _m("[Obecnie generowanie kluczy LTI jest wyłączone] "); } ?>
Jeśli Twój LMS wspiera
<a href="https://www.imsglobal.org/specs/lticiv1p0" target="_blank">
Learning Tools Interoperability® Content-Item Message</a>, to możesz się zalogować
i poprosić o klucz i sekret LTI 1.x, tak by zainstalować tę witrynę internetową 
w swoim LMSie jako repozytorium App Store / repozytorum Learning Object, 
co pozwala w systemie LMS na tworzenie własnych zajęć poprzez wybieranie narzędzi
i treści z tej witryny. Po otrzymaniu klucza i sekretu, dostaniesz również instrukcje
dotyczące konfiguracji.
</p>
</li>
<li><p>
<?php if ( !isset($CFG->google_classroom_secret) ) { echo _m("[Obecnie niedostępne] "); } ?>
Jeżeli używasz
<a href="https://classroom.google.com" target="_blank">Google Classroom</a>,
możesz automatycznie linkować zasoby z tej strony w trybie
<a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">ograniczonego arkusza stylu lekcji</a> (musisz być zalogowany).
</p></li>
<li>
<p>
Jeśli Twój system LMS nie obsługuje ani Content Item, ani Common Cartridge, ale
obsługuje LTI, to możesz ręcznie skopiować do swojego LMSa poszczególne linki
do materiałów tego kursu. Mamy specjalny, <a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">ograniczony widok lekcji</a>, tak aby ręczne kopiowanie było tak łatwe, jak to tylko możliwe.
</p>
</li>
</ul>
<h2>Archiwum audio</h2>
<p>
Tutaj znajduje się archiwalny
<a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">zapis wykładów na żywo</a>
z kursu SI502, którego uczyłem na Uniwersytecie Michigan w School of Information jesienią 2015 r.
</p>


<?php include("footer.php"); ?>

