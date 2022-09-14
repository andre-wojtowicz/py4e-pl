<?php include("top.php"); ?>
<?php include("nav.php"); ?>

<style>
[id]::before {
  content: '';
  display: block;
  height:      75px;
  margin-top: -75px;
  visibility: hidden;
  position: relative; 
  z-index: -1;
}
</style>

<h1 id="python-3-na-systemie-windows">Python 3 na systemie Windows</h1>

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
<div style="float: right; border-left:0px; border-right:0px; border-bottom:0px; max-width:150px; border-top: 2px solid #f90; padding: 8px 0; margin: 0; line-height: 11px;">
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

<nav id="TOC">
    <ul>
        <li>
            <a href="#instalacja-pythona">Instalacja Pythona</a>
            <ul>
                <li><a href="#sklep-microsoft">Sklep Microsoft</a></li>
                <li><a href="#strona-python.org">Strona python.org</a></li>
            </ul>
        </li>
        <li>
            <a href="#instalacja-edytora-tekstu-atom">Instalacja edytora tekstu Atom</a>
            <ul>
                <li><a href="#prosty-skrypt-pythona">Prosty skrypt Pythona</a></li>
            </ul>
        </li>
        <li><a href="#włączenie-wyświetlania-rozszerzeń-plików">Włączenie wyświetlania rozszerzeń plików</a></li>
        <li>
            <a href="#wiersz-poleceń">Wiersz poleceń</a>
            <ul>
                <li><a href="#uruchomienie-wiersza-poleceń">Uruchomienie wiersza poleceń</a></li>
                <li><a href="#uruchomienie-skryptu-pythona">Uruchomienie skryptu Pythona</a></li>
                <li><a href="#uruchomienie-sesji-interaktywnej-pythona">Uruchomienie sesji interaktywnej Pythona</a></li>
            </ul>
        </li>
    </ul>
</nav>

<p>Poniższe materiały opisują:</p>
<ul>
    <li>instalację Pythona 3,</li>
    <li>instalację i konfigurację edytora tekstu Atom i utworzenie prostego skryptu Pythona,</li>
    <li>włączenie wyświetlania rozszerzeń plików,</li>
    <li>uruchamianie interpretera i skryptów Pythona z poziomu wiersza poleceń.</li>
</ul>
<p>Materiały dotyczą systemu Windows 10, jednak w większości przypadków mają również zastosowanie przy wcześniejszych wersjach systemu Windows.</p>
<p>Na YouTube znajduje się <a href="https://www.youtube.com/watch?v=uZbaYeYGYRQ">krótki film</a> pokazujący jak zainstalować Pythona i edytor Atom oraz jak przygotować i uruchomić pierwszy skrypt Pythona.</p>
<h2 id="instalacja-pythona">Instalacja Pythona</h2>
<p>Każda stosunkowo aktualna wersja Pythona wystarczy do ukończenia tego kursu. Jeżeli posiadasz już na swoim komputerze Pythona w wersji 3.x, to nie ma konieczności instalacji jego najnowszej wersji.</p>
<p>Pythona można zainstalować na kilka sposobów. Tutaj opiszemy dwa główne podejścia, tj. poprzez:</p>
<ol type="1">
    <li>Sklep Microsoft (ang. <em>Microsoft Store</em>),</li>
    <li>instalator pobrany ze strony projektu Python.</li>
</ol>
<p>
    Instalacja poprzez Sklep Microsoft jest najłatwiejsza i najwygodniejsza, a ponadto nie wymaga uprawnień administratora. W przypadku systemów wcześniejszych niż Windows 10, można zainstalować Pythona ręcznie poprzez pobranie pliku
    instalatora z ww. strony. Poniżej opiszemy dwie metody instalacji Pythona.
</p>
<h3 id="sklep-microsoft">Sklep Microsoft</h3>
<p>Na pasku zadań klikamy na ikonę Windowsa:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-start.png" /></p>
<p>Po kliknięciu pojawi się lista programów dostępna w Menu Start:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-menu.png" /></p>
<p>
    Wpisujemy <code>Microsoft Store</code>. Nie trzeba nigdzie klikać aby wybrać miejsce do wpisywania – zobaczymy, że po podaniu pierwszej litery automatycznie pojawi się nowe okno i będziemy wprowadzali tekst w jego dolnej części. Gdy
    pojawi się aplikacja <code>Microsoft Store</code>, to na nią klikamy aby ją uruchomić:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-launch.png" /></p>
<p>
    Po uruchomieniu aplikacji, wyszukujemy w Sklepie aplikacje po słowie <code>python</code>. Możemy poczekać aż pojawi się krótka lista dostępnych aplikacji lub możemy zatwierdzić klawiszem <code>&lt;Enter&gt;</code> nasze wyszukiwanie. W
    obu przypadkach wybieramy najnowszego Pythona (w momencie tworzenia tej strony najnowszą wersją był Python 3.9, jednak bardzo możliwe, że teraz jest już dostępna nowsza wersja i taką też należałoby zainstalować):
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-search-1.png" /></p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-search-2.png" /></p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-search-3.png" /></p>
<p>Po wyświetleniu się strony informacyjnej, klikamy na przycisk <code>Pobierz</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-download.png" /></p>
<p><em>Uwaga</em>: jeżeli pojawi nam się okno z prośbą o zalogowanie, to możemy je zamknąć.</p>
<p>Czekamy na pobranie i zainstalowanie plików:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-install.png" /></p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-installed.png" /></p>
<p>Następnie zamykamy aplikację <code>Microsoft Store</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/store-close.png" /></p>
<h3 id="strona-python.org">Strona python.org</h3>
<p>
    Jeżeli nie możemy zainstalować Pythona przez Sklep Microsoftu, to możemy alternatywnie pobrać plik instalatora ze strony internetowej projektu Python. Wchodzimy na stronę
    <a href="https://www.python.org" class="uri">https://www.python.org</a> i w menu <code>Downloads</code> klikamy na przycisk w sekcji <code>Download for Windows</code> (w momencie tworzenia tej strony najnowszą wersją był Python 3.9.1,
    jednak bardzo możliwe, że teraz jest już dostępna nowsza wersja i taką też należałoby zainstalować):
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/website-download.png" /></p>
<p>
    <strong>Uwaga</strong>: jeżeli zamierzamy pracować na systemach wcześniejszych niż Windows 10 (np. Windows 7 lub Windows XP), to należy pobrać odpowiedni instalator ze strony
    <a href="https://www.python.org/downloads/windows/" class="uri">https://www.python.org/downloads/windows/</a>. Najnowsze wydania Pythona 3 nie obsługują starszych wersji systemu Windows, dlatego też konieczny jest wybór ostatniej wersji
    Pythona działającej na naszym systemie. Np. wersja <a href="https://www.python.org/downloads/release/python-387/">3.8.7</a> na systemie Windows 7, a wersja <a href="https://www.python.org/downloads/release/python-344/">3.4.4</a> działa
    na systemie Windows XP (w obu przypadkach na dole stron są linki do instalatorów, które posiadają w nazwie słowa "Windows" oraz "installer"). Poszczególne kroki instalacji mogą się różnić od tych opisanych poniżej.
</p>
<p>Po pobraniu pliku uruchamiamy instalator Pythona:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/website-installer.png" /></p>
<p>W nowym oknie instalatora Pythona:</p>
<ol type="1">
    <li>zaznaczamy opcję <code>☑ Add Python 3.9 to PATH</code>,</li>
    <li>wybieramy <code>Customize installation</code>.</li>
</ol>
<p><img style="max-width: 100%;" src="screenshots/windows/wizard-1.png" /></p>
<p>
    Jeżeli nie chcemy instalować Pythona dla wszystkich użytkowników naszego komputera albo nie posiadamy praw administratora systemu, to w kolejnym oknie odznaczamy opcję <code>☐ for all users (requires elevation)</code>. Następnie klikamy
    na <code>Next</code>:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/wizard-2.png" /></p>
<p>W kolejnym oknie klikamy na <code>Install</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/wizard-3.png" /></p>
<p>Czekamy na zakończenie procesu instalacji Pythona:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/wizard-4.png" /></p>
<p>
    Po instalacji, w ostatnim oknie mamy jeszcze możliwość wyłączenia limitu długości ścieżki plików i katalogów. Z punktu widzenia uruchamiania skryptów Pythona jest to dla nas przydatna opcja, więc jeśli mamy uprawnienia administratora,
    to klikamy na <code>Disable path length limit</code>. Następnie klikamy na <code>Close</code>.
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/wizard-5.png" /></p>
<h2 id="instalacja-edytora-tekstu-atom">Instalacja edytora tekstu Atom</h2>
<p>
    Nasze skrypty Pythona będziemy tworzyli w edytorze tekstowym. Zasadniczo może być to dowolny edytor tekstowy lub nawet zintegrowane środowisko programistyczne (IDE). Jest wiele dostępnych opcji, natomiast do początkowej nauki wystarczy
    nam edytor Atom (instalacja nie wymaga praw administratora).
</p>
<p>Wchodzimy na stronę <a href="https://atom.io" class="uri">https://atom.io</a> i pobieramy instalator:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-download.png" /></p>
<p>Po pobraniu pliku uruchamiamy instalator Atoma:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-installer.png" /></p>
<p>Proces instalacji odbywa się automatycznie, nie wymaga od nas żadnej interakcji:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-installing.png" /></p>
<p>Po zakończonej instalacji Atom automatycznie się uruchomi. Na początku skonfigurujemy kilka podstawowych opcji. W pierwszym oknie możemy zaznaczyć, że Atom ma domyślne otwierać linki zaczynające się od <code>atom://</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-config-uri.png" /></p>
<p>W głównej części programu kolejno:</p>
<ol type="1">
    <li>odznaczamy <code>☐ Show Welcome Guide when opening Atom</code>,</li>
    <li>zamykamy kartę <code>Welcome</code>,</li>
    <li>zamykamy kartę <code>Welcome Guide</code>.</li>
</ol>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-config-welcome.png" /></p>
<p>Następnie wyłączamy telemetrię:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-config-telemetry.png" /></p>
<p>
    Teraz możemy ustawić katalog, w którym będą znajdowały się nasze skrypty. Np. na Pulpicie możemy utworzyć katalog <code>skrypty</code>, a następnie w Atomie klikamy na <code>Add folders</code> i wybieramy utworzony przed chwilą katalog:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-config-add-folder.png" /></p>
<p>Po ustawieniu katalogu możemy zaważyć, że wyświetlił się od w pasku tytułowym aplikacji oraz w lewym menu:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-folder.png" /></p>
<h3 id="prosty-skrypt-pythona">Prosty skrypt Pythona</h3>
<p>Utworzymy teraz nasz pierwszy skrypt. Wybieramy w menu <code>File &gt; New File</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-new-file.png" /></p>
<p>W głównej części ekranu pojawi się miejsce na wpisanie kodu skryptu. Utwórzmy najprostszy skrypt o treści <code>print(123)</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-code-added.png" /></p>
<p>Zapiszmy teraz nasz skrypt. Wybieramy w menu <code>File &gt; Save</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-save-file.png" /></p>
<p>Skrypty Pythona mają rozszerzenie <code>.py</code>, zatem zapiszemy skrypt jako plik <code>hello.py</code>. Zauważmy, że nasz skrypt zostanie automatycznie zapisany w utworzonym przez nas katalogu:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-hello.png" /></p>
<p>
    Po zapisaniu skryptu, w lewym menu pojawi się nasz plik, a w głównej części ekranu karta zmieni tytuł na podaną przez nas nazwę pliku. Co więcej, dzięki temu, że zapisaliśmy plik jako skrypt Pythona, Atom może zastosować kolorowanie
    składni kodu, dzięki czemu kod staje się czytelniejszy:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-file-saved.png" /></p>
<p>Jeżeli będziemy chcieli uruchomić później edytor Atom, to możemy go uruchomić przez Menu Start lub przez skrót na Pulpicie, który utworzył instalator programu:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/atom-run.png" /></p>
<h2 id="włączenie-wyświetlania-rozszerzeń-plików">Włączenie wyświetlania rozszerzeń plików</h2>
<p>Otwórzmy w systemowym Eksploratorze plików katalog, w którym znajduje się nasz skrypt <code>hello.py</code>.</p>
<p><img style="max-width: 100%;" src="screenshots/windows/explorer-1.png" /></p>
<p>
    Domyślnie Windows nie wyświetla rozszerzeń plików, przez co rozpoznanie plików o tej samej nazwie, ale o różnych rozszerzeniach, może być kłopotliwe. Ponadto zmiana rozszerzenia istniejącego już pliku nie jest taka oczywista
    (teoretycznie moglibyśmy mieć taką potrzebę gdybyśmy popełnili literówkę w nazwie rozszerzenia skryptu Pythona, przez co Atom nie byłby w stanie poprawnie rozpoznać pliku).
</p>
<p>W Eksploratorze wybieramy kartę <code>Widok</code>, a następnie zaznaczamy <code>☑ Rozszerzenia nazw plików</code>. Teraz zauważymy, że wyświetlana jest już pełna nazwa pliku <code>hello.py</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/explorer-2.png" /></p>
<h2 id="wiersz-poleceń">Wiersz poleceń</h2>
<p>
    Będziemy uruchamiali Pythona poprzez klasyczny wiersz poleceń dostępny w systemie Windows. Mogą pojawić się wątpliwości czy nie lepiej byłoby uruchamiać Pythona bezpośrednio z Menu Start albo poprzez podwójne kliknięcie na skrypcie z
    rozszerzeniem <code>.py</code>. Uruchamiając Pythona z poziomu wiersza poleceń będziemy mogli:
</p>
<ul>
    <li>szybko testować nasze skrypty,</li>
    <li>zobaczyć wynik programu po jego zakończeniu,</li>
    <li>ustawić wcześniej katalog roboczy, co będzie istotne gdy zaczniemy uczyć się w jaki sposób przetwarzać pliki z danymi.</li>
</ul>
<p>W dalszej części zobaczymy w jaki sposób:</p>
<ol type="1">
    <li>uruchomić wiersz poleceń,</li>
    <li>ustawić katalog roboczy,</li>
    <li>uruchomić skrypt Pythona,</li>
    <li>uruchomić i zakończyć sesję interaktywną Pythona.</li>
</ol>
<h3 id="uruchomienie-wiersza-poleceń">Uruchomienie wiersza poleceń</h3>
<p>Na pasku zadań klikamy na ikonę Windowsa:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/cmd-start.png" /></p>
<p>Po kliknięciu pojawi się lista programów dostępna w Menu Start:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/cmd-menu.png" /></p>
<p>
    Wpisujemy <code>Wiersz polecenia</code> (ew. jeśli działamy na angielskiej wersji systemu, to wpisujemy <code>Command prompt</code>). Nie trzeba nigdzie klikać aby wybrać miejsce do wpisywania – zobaczymy, że po podaniu pierwszej litery
    automatycznie pojawi się nowe okno i będziemy wprowadzali tekst w jego dolnej części. Gdy pojawi się aplikacja <code>Wiersz polecenia</code>, to na nią klikamy aby ją uruchomić:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/cmd-launch.png" /></p>
<p><em>Uwaga</em>: innym sposobem na uruchomienie wiersza poleceń jest wciśnięcie klawiszy <code>&lt;Windows+R&gt;</code>, wpisanie w nowym oknie <code>cmd.exe</code> i wybranie <code>OK</code>.</p>
<p>Po uruchomieniu zobaczymy czarne okno programu wiersza poleceń, które będzie zawierało komunikat podobny do <code>C:\Users\nazwa_użytkownika&gt;</code> lub <code>C:\Windows\System32&gt;</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/cmd-opened.png" /></p>
<h4 id="ustawienie-katalogu-roboczego">Ustawienie katalogu roboczego</h4>
<p>Tak jak w Eksploratorze plików możemy chodzić po katalogach, tak samo w wierszu poleceń możemy zmieniać katalogi, w których obecnie jesteśmy.</p>
<p>
    Po uruchomieniu wiersza poleceń najczęściej będziemy się znajdowali w naszym <strong>katalogu domowym</strong>. Ścieżka do katalogu domowego zależy od wersji systemu Windows. W każdym z poniższych przykładów, zamiast
    <code>csev</code> powinna być nazwa konta, na którym jesteś obecnie zalogowany:
</p>
<pre class="plaintext"><code>Windows XP:              C:\Documents and Settings\csev
Windows Vista:           C:\Users\csev
Windows 7:               C:\Users\csev
Windows 10:              C:\Users\csev
Windows 10 z OneDrive:   C:\Users\csev\OneDrive</code></pre>
<p>Jak widać powyżej, w systemie Windows 10 czasami włączona jest usługa OneDrive i wszystkie pliki użytkownika są automatycznie synchronizowane do chmury Microsoftu, przez co ścieżka do katalogu domowego jest nieco inna.</p>
<p>
    W wierszu poleceń znajduje się informacja o tym gdzie obecnie się znajdujesz w hierarchii katalogów na dysku twardym. Informacja o tym zwykle wyświetlana jest przed tzw. <em>znakiem zachęty</em>. Katalog, w którym obecnie się
    znajdujesz, nazywa się <strong>katalogiem roboczym</strong>.
</p>
<p>Wiersz poleceń wyświetla znak zachęty w formacie zawierającym ścieżkę katalogu roboczego, a następnie znak <code>&gt;</code>. Może to być np.:</p>
<pre class="plaintext"><code>C:\Users\csev&gt;</code></pre>
<p>lub rzadziej:</p>
<pre class="plaintext"><code>C:\Windows\System32&gt;</code></pre>
<p>
    Chcemy ustawić katalog roboczy na taki, w którym znajdują się nasze skrypty Pythona. Najprostszym sposobem na ustalenie ścieżki do tego katalogu jest wejście do katalogu poprzez Eksplorator plików, wyświetlenie właściwości jakiegoś
    skryptu i spojrzenie na miejsce lokalizacji. W poniższym przykładzie jest to <code>C:\Users\csev\Desktop\skrypty</code>:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/file-properties-1.png" /></p>
<p><img style="max-width: 100%;" src="screenshots/windows/file-properties-2.png" /></p>
<p>Aby zmienić katalog roboczy wiersza poleceń, posłużymy się komendą <code>cd</code> (z ang. <em>change directory</em>). Z polecenia korzystamy podając nazwę lub pełną ścieżkę katalog, do którego chcemy się dostać.</p>
<p>
    W poniższym przykładzie możemy zobaczyć w jaki sposób zmieniliśmy katalog roboczy z <code>C:\Windows\System32</code> na <code>C:\Users\csev\Desktop\skrypty</code>. Dla ułatwienia możemy wyświetlić obok siebie wiersz poleceń oraz okno
    właściwości pliku, z którego weźmiemy docelową ścieżkę katalogu. Po zmianie katalogu możemy zamknąć okno właściwości pliku:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/cmd-working-dir-change.png" /></p>
<h4 id="kilka-wskazówek">Kilka wskazówek</h4>
<ol type="1">
    <li>
        W powyższym przykładzie w poleceniu <code>cd</code> użyliśmy pełnej ścieżki docelowego katalogu, czyli tzw. <em>ścieżki bezwzględnej</em>. Nie musimy zawsze podawać pełnej ścieżki. Np. jeśli znajdujemy się w katalogu
        <code>C:\Users\csev</code> i chcemy przejść do katalogu <code>Desktop</code>, to wystarczy, że podamy tzw. <em>ścieżkę względną</em>, czyli taką, która odnosi się do naszej aktualnej lokalizacji. W takim przypadku zmiana katalogu
        mogłaby się odbyć poprzez polecenie <code>cd Desktop</code>.
    </li>
    <li>Polecenie <code>cd ..</code> pozwala przejść "w górę" katalogu, czyli do katalogu nadrzędnego.</li>
    <li>
        W poleceniu <code>cd</code> możesz częściowo wpisać nazwę katalogu, np. <code>Des</code> zamiast <code>Desktop</code>, a następnie nacisnąć klawisz <code>&lt;Tab&gt;</code>. Dzięki temu system automatycznie uzupełni nazwę katalogu,
        o ile wpisałeś ją na tyle, że system będzie mógł precyzyjnie wskazać katalog, który miałeś na myśli.
    </li>
    <li>Możesz użyć polecenia <code>dir</code>, tak aby zobaczyć pliki znajdujące się w aktualnym katalogu.</li>
    <li>Jeśli masz na komputerze kilka dysków, to np. polecenie <code>D:</code> zmienia katalog roboczy na dysk D.</li>
    <li>
        Jeśli klikniesz na małą ikonkę w lewym górnym rogu okna wiersza poleceń i wybierzesz <code>Właściwości</code>, to będziesz mógł ustawić wiele rzeczy dotyczących wiersza poleceń. Prawdopodobnie najważniejsze jest ustawienie rozmiaru
        bufora historii poleceń na 999.
    </li>
    <li>
        Jeżeli nie wiesz w którym katalogu się znajdujesz i/lub nie wiesz jak dostać się do danego katalogu, to po prostu zamknij i ponownie otwórz okno wiersza linii poleceń. Powrócisz wtedy do początkowej, znanej Ci lokalizacji i będziesz
        mógł ponownie nawigować po katalogach.
    </li>
</ol>
<h3 id="uruchomienie-skryptu-pythona">Uruchomienie skryptu Pythona</h3>
<p>Załóżmy, że chcemy uruchomić skrypt <code>hello.py</code>. Uruchamiamy wiersz poleceń i ustawiamy katalog roboczy na katalog, który zawiera ww. skrypt.</p>
<p>
    Skrypt uruchamiamy poprzez polecenie <code>python3 &lt;nazwa-skryptu&gt;</code> lub <code>python &lt;nazwa-skryptu&gt;</code>. Jeśli instalowaliśmy Pythona przez instalator pobrany ze strony internetowej, to najprawdopodobniej zadziała
    tylko druga wersja, ale jest to zależne od konkretnego systemu, więc warto sprawdzić obie metody.
</p>
<p>
    Poniżej widzimy uruchomienie skryptu <code>hello.py</code>, który znajduje się w katalogu <code>C:\Users\csev\Desktop\skrypty</code> (katalog roboczy został odpowiednio wcześniej ustawiony przy pomocy polecenia <code>cd</code>). Po
    uruchomieniu Pythona widzimy wynik działania skryptu, a następnie kontrola wraca z powrotem do wiersza poleceń:
</p>
<p><img style="max-width: 100%;" src="screenshots/windows/python-run-script.png" /></p>
<p>
    W wierszu poleceń możesz użyć klawisza strzałki <strong>w górę</strong> <code>&lt;↑&gt;</code>, tak aby przewijać poprzednie polecenia, a potem nacisnąć klawisz <code>&lt;Enter&gt;</code> aby ponownie je wykonać. Jest to szczególnie
    przydatne jeśli zmieniamy zawartość skryptu i chcemy go szybko ponownie uruchomić w celu przetestowania dokonanych zmian.
</p>
<p>Jeśli lubisz mieć porządek na ekranie, możesz wyczyścić ekran wydając w wierszu poleceń komendę <code>cls</code>.</p>
<h3 id="uruchomienie-sesji-interaktywnej-pythona">Uruchomienie sesji interaktywnej Pythona</h3>
<p>
    Pythona możemy również poznawać poprzez interaktywny interpreter. Aby go uruchomić, w wierszu poleceń wydajemy komendę <code>python3</code> lub <code>python</code>. Jeśli instalowaliśmy Pythona przez instalator pobrany ze strony
    internetowej, to najprawdopodobniej zadziała tylko druga wersja, ale jest to zależne od konkretnego systemu, więc warto sprawdzić obie metody.
</p>
<p>Po uruchomieniu interpretera zobaczymy znak zachęty w postaci jodełki <code>&gt;&gt;&gt;</code>. Możemy wydać polecenie <code>print('witaj')</code> i zatwierdzić je klawiszem <code>&lt;Enter&gt;</code>:</p>
<p><img style="max-width: 100%;" src="screenshots/windows/python-run-interpreter.png" /></p>
<p>
    Aby zakończyć działanie interpretera Pythona, wydajemy polecenie <code>quit()</code>. Pod Windowsem, alternatywnie zamiast tego polecenia, możemy wcisnąć kombinację klawiszy <code>&lt;Ctrl+Z&gt;</code>, a potem
    <code>&lt;Enter&gt;</code>. W ostateczności możemy po prostu zamknąć okno wiersza poleceń.
</p>


<?php include('footer.php');?>
