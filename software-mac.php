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

<h1 id="python-3-na-systemie-macos">Python 3 na systemie macOS</h1>

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
        <li><a href="#instalacja-pythona">Instalacja Pythona</a></li>
        <li>
            <a href="#instalacja-edytora-tekstu-atom">Instalacja edytora tekstu Atom</a>
            <ul>
                <li><a href="#prosty-skrypt-pythona">Prosty skrypt Pythona</a></li>
            </ul>
        </li>
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
    <li>instalację edytora tekstu Atom i utworzenie prostego skryptu Pythona,</li>
    <li>uruchamianie interpretera i skryptów Pythona z poziomu wiersza poleceń.</li>
</ul>
<p>Na YouTube znajduje się <a href="https://www.youtube.com/watch?v=aIcLCww_kQM">krótki film</a> pokazujący jak zainstalować Pythona i edytor Atom oraz jak przygotować i uruchomić pierwszy skrypt Pythona.</p>
<h2 id="instalacja-pythona">Instalacja Pythona</h2>
<p>Każda stosunkowo aktualna wersja Pythona wystarczy do ukończenia tego kursu. Jeżeli posiadasz już na swoim komputerze Pythona w wersji 3.x, to nie ma konieczności instalacji jego najnowszej wersji.</p>
<p><em>Uwaga</em>: Python w wersji 2.x jest już zainstalowany na systemie operacyjnym macOS.</p>
<p>Pobierz i zainstaluj Pythona 3 ze strony <a href="https://www.python.org" class="uri">https://www.python.org</a>.</p>
<h2 id="instalacja-edytora-tekstu-atom">Instalacja edytora tekstu Atom</h2>
<p>Pobierz i zainstaluj program Atom ze strony <a href="https://atom.io" class="uri">https://atom.io</a>.</p>
<p>Po zakończonej instalacji Atom automatycznie się uruchomi. Na początku skonfigurujemy kilka podstawowych opcji. W pierwszym oknie możemy zaznaczyć, że Atom ma domyślne otwierać linki zaczynające się od <code>atom://</code>.</p>
<p>W głównej części programu kolejno:</p>
<ol type="1">
    <li>odznaczamy <code>☐ Show Welcome Guide when opening Atom</code>,</li>
    <li>zamykamy kartę <code>Welcome</code>,</li>
    <li>zamykamy kartę <code>Welcome Guide</code>.</li>
</ol>
<p>Następnie wyłączamy telemetrię klikając na <code>No, do not send my usage data</code>.</p>
<p>
    Teraz możemy ustawić katalog, w którym będą znajdowały się nasze skrypty. Np. na Pulpicie możemy utworzyć katalog <code>skrypty</code>, a następnie w Atomie klikamy na <code>Add folders</code> i wybieramy utworzony przed chwilą katalog.
</p>
<h3 id="prosty-skrypt-pythona">Prosty skrypt Pythona</h3>
<p>Utworzymy teraz nasz pierwszy skrypt. Po uruchomieniu edytora Atom wybieramy w menu <code>File &gt; New File</code>.</p>
<p>W głównej części ekranu pojawi się miejsce na wpisanie kodu skryptu. Utwórzmy najprostszy skrypt o treści <code>print(123)</code>.</p>
<p>Zapiszmy teraz nasz skrypt. Wybieramy w menu <code>File &gt; Save</code>.</p>
<p>Skrypty Pythona mają rozszerzenie <code>.py</code>, zatem zapiszemy skrypt jako plik <code>hello.py</code>.</p>
<h2 id="wiersz-poleceń">Wiersz poleceń</h2>
<p>Będziemy uruchamiali Pythona poprzez klasyczny wiersz poleceń dostępny w systemie macOS. Uruchamiając Pythona z poziomu wiersza poleceń będziemy mogli:</p>
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
<p>Program Terminal znajduje się w <code>Finder &gt; Aplikacje &gt; Narzędzia &gt; Terminal</code>.</p>
<p>Alternatywnie możesz w prawej górnej części ekranu kliknąć na przycisk wyszukiwania Spotlight i wpisać <code>terminal</code>, a następnie uruchomić Terminal, który pojawi się na liście.</p>
<p>Możesz sprawić, że Terminal po uruchomieniu pozostanie zadokowany. Kliknij i przytrzymują ikonę Terminala w Docku, a następnie wybierz opcję “Zatrzymaj w Docku”. Następnie klikając na jego ikonę w Docku możesz szybko go uruchomić.</p>
<h4 id="ustawienie-katalogu-roboczego">Ustawienie katalogu roboczego</h4>
<p>Tak jak w eksploratorze plików możemy chodzić po katalogach, tak samo w wierszu poleceń możemy zmieniać katalogi, w których obecnie jesteśmy.</p>
<p>
    Po uruchomieniu wiersza poleceń najczęściej będziemy się znajdowali w naszym <strong>katalogu domowym</strong>. Ścieżka do katalogu domowego to np. <code>/Users/csev</code> (zamiast <code>csev</code> powinna być nazwa konta, na którym
    jesteś obecnie zalogowany)
</p>
<p>
    W wierszu poleceń znajduje się informacja o tym gdzie obecnie się znajdujesz w hierarchii katalogów na dysku twardym. Informacja o tym zwykle wyświetlana jest przed tzw. <em>znakiem zachęty</em>. Katalog, w którym obecnie się
    znajdujesz, nazywa się <strong>katalogiem roboczym</strong>.
</p>
<pre class="shell"><code>udhcp-macvpn-624:~ csev$</code></pre>
<p>Wiersz poleceń wyświetla znak zachęty w formacie zawierającym nazwę hosta, dwukropek, ścieżkę katalogu roboczego, nazwę użytkownika, a następnie znak <code>$</code>, po którym wprowadzamy komendy.</p>
<p>Jeśli chcesz wyświetlić pełną informację o ścieżce katalogu roboczego, wydaj polecenie <code>pwd</code> bez parametrów:</p>
<pre class="shell"><code>udhcp-macvpn-624:~ csev$ pwd
/Users/csev</code></pre>
<p>Jak widać, skrótowy zapis <code>~</code> katalogu domowego został rozwinięty do <code>/Users/csev</code>.</p>
<h4 id="kilka-wskazówek">Kilka wskazówek</h4>
<ol type="1">
    <li>Polecenie <code>pwd</code> wyświetla pełną ścieżkę naszego aktualnego katalogu.</li>
    <li>Możesz użyć polecenia <code>ls</code>, tak aby zobaczyć pliki znajdujące się w aktualnym katalogu.</li>
    <li>Polecenie <code>mkdir skrypty</code> tworzy katalog <code>skrypty</code> wewnątrz katalogu bieżącego.</li>
    <li>Polecenie <code>cd</code> lub <code>cd ~</code> przechodzi do katalogu domowego użytkownika.</li>
    <li>Polecenie <code>cd skrypty</code> pozwala przejść do katalogu o nazwie <code>skrypty</code>, który znajduje się w bieżącym katalogu (o ile katalog <code>skrypty</code> istnieje).</li>
    <li>Polecenie <code>cd ..</code> pozwala przejść “w górę” bieżącego katalogu, czyli do katalogu nadrzędnego.</li>
    <li>
        W poleceniu <code>cd</code> możesz częściowo wpisać nazwę katalogu, np. <code>skr</code> zamiast <code>skrypty</code>, a następnie nacisnąć klawisz <code>&lt;Tab&gt;</code>. Dzięki temu system automatycznie uzupełni nazwę katalogu,
        o ile wpisałeś ją na tyle, że system będzie mógł precyzyjnie wskazać katalog, który miałeś na myśli.
    </li>
    <li>Polecenie <code>touch test.py</code> tworzy pusty plik <code>test.py</code> w bieżącym katalogu.</li>
    <li>
        W wierszu poleceń możesz użyć klawisza strzałki <strong>w górę</strong> <code>&lt;↑&gt;</code>, tak aby przewijać poprzednie polecenia, a potem nacisnąć klawisz <code>&lt;Enter&gt;</code> aby ponownie je wykonać. Jest to szczególnie
        przydatne jeśli zmieniamy zawartość skryptu i chcemy go szybko ponownie uruchomić w celu przetestowania dokonanych zmian.
    </li>
    <li>Jeśli lubisz mieć porządek na ekranie, możesz wyczyścić ekran wydając w wierszu poleceń komendę <code>clear</code> lub używając kombinacji klawiszy <code>&lt;Command+K&gt;</code>.</li>
    <li>
        Jeżeli nie wiesz w którym katalogu się znajdujesz i/lub nie wiesz jak dostać się do danego katalogu, to po prostu zamknij i ponownie otwórz okno Terminala. Powrócisz wtedy do początkowej, znanej Ci lokalizacji i będziesz mógł
        ponownie nawigować po katalogach.
    </li>
</ol>
<h3 id="uruchomienie-skryptu-pythona">Uruchomienie skryptu Pythona</h3>
<p>Uruchomimy teraz program <code>hello.py</code> z poziomu wiersza poleceń:</p>
<pre class="shell"><code>udhcp-macvpn-624:~ csev$ cd Desktop
udhcp-macvpn-624:Desktop csev$ cd skrypty
udhcp-macvpn-624:Desktop/skrypty csev$ pwd
/Users/csev/Desktop/skrypty
udhcp-macvpn-624:Desktop/skrypty csev$ ls -l
total 8
-rw-r--r--  1 csev  staff   15 Sep 16 15:17 hello.py
udhcp-macvpn-624:Desktop/skrypty csev$ python3 hello.py
123
udhcp-macvpn-624:~ csev$</code></pre>
<p>Przeanalizujmy po kolei co robią powyższe polecenia:</p>
<ul>
    <li>
        <code>cd Desktop</code> i <code>cd skrypty</code> – (z ang. <em>change directory</em>) zmień katalog roboczy (czyli bieżący katalog); robimy to aby upewnić się, że zaczynamy w odpowiednim miejscu w hierarchii katalogów dostępnych w
        systemie; tak jak np. w eksploratorze plików możemy chodzić po katalogach, tak samo w wierszu poleceń możemy zmieniać katalogi, w których obecnie jesteśmy.
    </li>
    <li>
        <code>pwd</code> – (z ang. <em>print working directory</em>) wyświetl katalog roboczy; to polecenie informuje nas gdzie znajdujemy się w hierarchii katalogów; jesteśmy obecnie w naszym katalogu domowym; macOS to system, z którego
        jednocześnie może korzystać wielu użytkowników, a każdy użytkownik ma swój własny “katalog domowy”; możesz zbudować własną hierarchię katalogu idąc w głąb od swojego katalogu domowego.
    </li>
    <li><code>ls -l</code> – pokaż pliki i podkatalogi znajdujące się w bieżącym katalogu; opcja <code>-l</code> pokazuje dodatkowe szczegóły takie jak uprawnienia, data modyfikacji i rozmiar pliku.</li>
    <li><code>python3 hello.py</code> – uruchom Pythona 3 na pliku <code>hello.py</code>.</li>
</ul>
<p>Zalecamy abyś już od samego początku korzystał z terminala do uruchamiania swojego kodu, ponieważ ostatecznie i tak będziesz musiał z niej korzystać aby uruchomić bardziej skomplikowane programy.</p>
<h3 id="uruchomienie-sesji-interaktywnej-pythona">Uruchomienie sesji interaktywnej Pythona</h3>
<p>Pythona możemy również poznawać poprzez interaktywny interpreter. Aby go uruchomić, w wierszu poleceń wydajemy komendę <code>python3</code>.</p>
<p>Po uruchomieniu interpretera zobaczymy znak zachęty w postaci jodełki <code>&gt;&gt;&gt;</code>. Możemy wydać polecenie <code>print(&#39;witaj&#39;)</code> i zatwierdzić je klawiszem <code>&lt;Enter&gt;</code>:</p>
<pre class="shell"><code>udhcp-macvpn-624:Desktop/skrypty csev$ python3</code></pre>
<pre class="plaintext"><code>Python 3.8.0 (default, Nov 14 2019, 22:29:45) 
[GCC 5.4.0 20160609] on darwin
Type &quot;help&quot;, &quot;copyright&quot;, &quot;credits&quot; or &quot;license&quot; for more information.
&gt;&gt;&gt; print(&#39;witaj&#39;)
witaj
&gt;&gt;&gt;</code></pre>
<p>Aby zakończyć działanie interpretera Pythona, wydajemy polecenie <code>quit()</code>. Alternatywnie zamiast tego polecenia, możemy wcisnąć kombinację klawiszy <code>&lt;Ctrl+D&gt;</code>.</p>


<?php include('footer.php');?>
