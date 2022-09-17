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

<h1 id="python-3-na-platformie-pythonanywhere">Python 3 na platformie PythonAnywhere</h1>

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
            <div style="align-self: center;">druk czarno-biały</div>
            <div style="width: 5px"></div>
        </a>
    </div>
    <div class="book-primary-btn" style="margin-top: 5px; padding: 3px; width: 100%; border-width: 1px 0;">
        <a rel="nofollow" href="https://amzn.to/3DB8bgC" target="_blank" style="text-decoration: none; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; margin: 0; padding: 0; width: 100%; font: normal 14px/17px Arial,Helvetica,sans-serif; color: #333; font-size: 12px; text-align: center; display: flex; justify-content: space-between;">
            <div style=""><img src="https://py4e.pl/book-amz.png" style="height: 20px;" /></div>
            <div style="align-self: center;">druk kolorowy</div>
            <div style="width: 5px"></div>
        </a>
    </div>
</div>

<nav id="TOC">
    <ul>
        <li><a href="#rejestracja-w-celu-utworzenia-konta">Rejestracja w celu utworzenia konta</a></li>
        <li><a href="#pierwszy-program">Pierwszy program</a></li>
        <li>
            <a href="#korzystanie-z-powłoki-systemu-linux">Korzystanie z powłoki systemu Linux</a>
            <ul>
                <li><a href="#uruchomienie-skryptu-pythona">Uruchomienie skryptu Pythona</a></li>
                <li><a href="#uruchomienie-sesji-interaktywnej-pythona">Uruchomienie sesji interaktywnej Pythona</a></li>
                <li><a href="#edycja-plików">Edycja plików</a></li>
            </ul>
        </li>
    </ul>
</nav>

<p>Poniższe materiały opisują:</p>
<ul>
    <li>rejestrację w usłudze PythonAnywhere,</li>
    <li>utworzenie i uruchomienie skryptu Pythona poprzez interfejs graficzny,</li>
    <li>uruchamianie interpretera i skryptów Pythona z poziomu wiersza poleceń.</li>
</ul>
<p>
    <a href="https://www.pythonanywhere.com">PythonAnywhere</a> to bezpłatna usługa online, która umożliwia tworzenie i uruchamianie w przeglądarce internetowej programów napisanych w języku Python. Jest to w pełni funkcjonalne środowisko
    Linuxa z opartym na przeglądarce internetowej edytorem tekstu z podświetlaniem składni. Wszystko czego potrzebujesz do napisania i uruchomienia kodu Pythona, to przeglądarka internetowa. W ogóle nic nie musisz u siebie instalować.
</p>
<p>
    Oznacza to, że możesz ukończyć ten kurs w “zamkniętym środowisku”, pracując na systemach i urządzeniach takich jak iPad, iPhone, Android, ChromeBook, Windows itp. PythonAnywhere możesz również użyć jeśli korzystasz z komputera w pracy
    lub w szkole, czyli tam gdzie nie możesz zainstalować żadnego oprogramowania.
</p>
<h2 id="rejestracja-w-celu-utworzenia-konta">Rejestracja w celu utworzenia konta</h2>
<p>
    Aby korzystać z PythonAnywhere, musisz założyć konto (prawy górny róg <code>Pricing &amp; signup</code>). Mają bezpłatnę ofertę (<code>Beginner Account</code>), która spełni wszystkie Twoje potrzeby związane z tym kursem aż do rozdziału
    15.
</p>
<p>
    PythonAnywhere zobowiązuje się do umożliwienia Ci posiadania bezpłatnego konta na zawsze (pod warunkiem, że będziesz się na to konto logować i z niego korzystać). Usługa posiada również niedrogie oferty, które sprawdzą się w sytuacji, w
    której będziesz potrzebować więcej miejsca na dysku, większej mocy obliczeniowej dla swoich projektów, większej elastyczności lub dodatkowych funkcji. Podkreślmy jednak, że bezpłatna oferta wystarczy do ukończenia tego kursu.
</p>
<p>Zarejestruj się, potwierdź adres e-mail i zaloguj się na stronie PythonAnywhere.</p>
<h2 id="pierwszy-program">Pierwszy program</h2>
<p>
    Po zalogowaniu się, przejdź do zakładki plików (<code>Files</code>) i utwórz nowy w swoim katalogu domowym plik o nazwie <code>hello.py</code> (jeśli tworzysz plik w panelu kontrolnym <code>Dashboard</code>, to musisz dodatkowo podać
    pełną ścieżkę do pliku; powinno to być coś w rodzaju <code>/home/drchuck</code>). Umieść w pliku następujący wiersz:
</p>
<div class="sourceCode" id="cb1">
    <pre class="sourceCode python"><code class="sourceCode python"><a class="sourceLine" id="cb1-1" title="1"><span class="bu">print</span>(<span class="st">&#39;Witaj świecie&#39;</span>)</a></code></pre>
</div>
<p>Zapisz plik, wybierz <code>Run</code>, a następnie powinieneś zobaczyć:</p>
<pre class="plaintext"><code>Witaj świecie
&gt;&gt;&gt;</code></pre>
<p>Następnie zamień tekst wewnątrz <code>print(...)</code> na <code>'Witaj PY4E świecie'</code>, wybierz <code>Save</code>, a potem <code>Run</code>, co powinno uruchomić Twój zmodyfikowany program.</p>
<p>
    O ile przycisk <code>Run</code> działa w przypadku kilkulinijkowych programów, po rozpoczęciu pracy nad bardziej złożonymi programami konieczne będzie użycie powłoki systemu Linux (wiersza poleceń). Na początku może się to wydawać
    trochę nieintuicyjne, ale nauczenie się absolutnych podstaw Linuxa to świetny pomysł, ponieważ jest to system, który dominuje na różnego rodzaju serwerach.
</p>
<h2 id="korzystanie-z-powłoki-systemu-linux">Korzystanie z powłoki systemu Linux</h2>
<p>
    Przekonasz się, że często szybsze i łatwiejsze jest wprowadzanie niewielkich zmian w plikach z poziomu wiersza poleceń, a nie w pełnoekranowym graficznym interfejsie użytkownika. A kiedy zaczniesz już wdrażać rzeczywiste aplikacje w
    środowiskach chmurowych dostarczanych przez Google, Amazon, Microsoft itp., to wszystko, a zarazem jedyne co będziesz mieć do dyspozycji, to wiersz poleceń.
</p>
<p>
    Najlepiej będzie jeśli otworzysz dwa okna przeglądarki internetowej, jedno obok drugiego. W pierwszym oknie otwórz pliki (<code>Files</code>), a w drugim konsole (<code>Consoles</code>). Jeśli masz już uruchomioną konsolę Bash, to
    możesz do niej teraz powrócić; w przeciwnym razie uruchom nową konsolę Bash. Po uruchomieniu konsoli Bash powinieneś zobaczyć mniej więcej coś takiego:
</p>
<pre class="shell"><code>14:12 ~ $</code></pre>
<p>Jest to wiersz poleceń systemu Linux. Widzimy kolejno:</p>
<ul>
    <li>aktualną godzinę,</li>
    <li>katalog roboczy (czyli miejsce, w którym się znajdujemy); tutaj jest to <code>~</code>, czyli skrótowy zapis naszego katalogu domowego (np. <code>/home/drchuck</code>),</li>
    <li>znak zachęty <code>$</code>, za którym wprowadzamy nasze polecenia.</li>
</ul>
<p>
    Pod Linuxem pliki są zorganizowane w drzewiastej hierarchicznej strukturze. Na samym szczycie hierarchii jest katalog główny <code>/</code>. Katalogi domowe użytkowników znajdują się w katalogu <code>/home</code>. Nasze skrypty będą
    znajdowały się w naszym katalogu domowym, czyli np. <code>/home/drchuck</code>.
</p>
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
    <li>Jeśli lubisz mieć porządek na ekranie, możesz wyczyścić ekran wydając w wierszu poleceń komendę <code>clear</code> lub używając kombinacji klawiszy <code>&lt;Ctrl+L&gt;</code>.</li>
</ol>
<h3 id="uruchomienie-skryptu-pythona">Uruchomienie skryptu Pythona</h3>
<p>Uruchomimy teraz program <code>hello.py</code> z poziomu wiersza poleceń:</p>
<pre class="shell"><code>14:14 ~ $ cd
14:14 ~ $ pwd
/home/drchuck
14:15 ~ $ ls -l
-rw-rw-r--  1 drchuck registered_users   27 Mar 29 14:10 hello.py
14:16 ~ $ python3 hello.py
Witaj PY4E świecie
14:16 ~ $</code></pre>
<p>Przeanalizujmy po kolei co robią powyższe polecenia:</p>
<ul>
    <li>
        <code>cd</code> – (z ang. <em>change directory</em>) zmień katalog roboczy (czyli bieżący katalog) na Twój katalog domowy; robimy to aby upewnić się, że zaczynamy w odpowiednim miejscu w hierarchii katalogów dostępnych w systemie;
        tak jak np. pod Windowsem w Eksploratorze plików możemy chodzić po katalogach, tak samo w wierszu poleceń możemy zmieniać katalogi, w których obecnie jesteśmy.
    </li>
    <li>
        <code>pwd</code> – (z ang. <em>print working directory</em>) wyświetl katalog roboczy; to polecenie informuje nas gdzie znajdujemy się w hierarchii katalogów; jesteśmy obecnie w naszym katalogu domowym; Linux to system, z którego
        jednocześnie może korzystać wielu użytkowników, a każdy użytkownik ma swój własny “katalog domowy”; możesz zbudować własną hierarchię katalogu idąc w głąb od swojego katalogu domowego.
    </li>
    <li><code>ls -l</code> – pokaż pliki i podkatalogi znajdujące się w bieżącym katalogu; opcja <code>-l</code> pokazuje dodatkowe szczegóły takie jak uprawnienia, data modyfikacji i rozmiar pliku.</li>
    <li><code>python3 hello.py</code> – uruchom Pythona 3 na pliku <code>hello.py</code>.</li>
</ul>
<p>Zalecamy abyś już od samego początku korzystał w Linuxie z powłoki Bash do uruchamiania swojego kodu, ponieważ ostatecznie i tak będziesz musiał z niej korzystać aby uruchomić bardziej skomplikowane programy.</p>
<h3 id="uruchomienie-sesji-interaktywnej-pythona">Uruchomienie sesji interaktywnej Pythona</h3>
<p>Pythona możemy również poznawać poprzez interaktywny interpreter. Aby go uruchomić, w wierszu poleceń wydajemy komendę <code>python3</code>.</p>
<p>Po uruchomieniu interpretera zobaczymy znak zachęty w postaci jodełki <code>&gt;&gt;&gt;</code>. Możemy wydać polecenie <code>print('witaj')</code> i zatwierdzić je klawiszem <code>&lt;Enter&gt;</code>:</p>
<pre class="shell"><code>14:55 ~ $ python3</code></pre>
<pre class="plaintext"><code>Python 3.8.0 (default, Nov 14 2019, 22:29:45) 
[GCC 5.4.0 20160609] on linux
Type &quot;help&quot;, &quot;copyright&quot;, &quot;credits&quot; or &quot;license&quot; for more information.
&gt;&gt;&gt; print(&#39;witaj&#39;)
witaj
&gt;&gt;&gt;</code></pre>
<p>Aby zakończyć działanie interpretera Pythona, wydajemy polecenie <code>quit()</code>. Pod Linuxem, alternatywnie zamiast tego polecenia, możemy wcisnąć kombinację klawiszy <code>&lt;Ctrl+D&gt;</code>.</p>
<h3 id="edycja-plików">Edycja plików</h3>
<p>Istnieją trzy sposoby edytowania plików w środowisku PythonAnywhere, od najłatwiejszego do najfajniejszych. Wystarczy, że będziesz potrafić edytować plik przy pomocy jednego z poniższych sposobów.</p>
<ol type="1">
    <li>Przejdź do panelu kontrolnego PythonAnywhere (<code>Dashboard</code>), następnie do plików (<code>Files</code>), a potem do właściwego katalogu i edytuj plik klikając na niego.</li>
    <li>
        <p>W Bashu przejdź do odpowiedniego katalogu i otwórz plik przy pomocy edytora <code>nano</code>. Poniżej pokazano w jaki sposób można edytować plik <code>hello.py</code>:</p>
        <pre class="shell"><code>15:02 ~ $ cd
15:02 ~$ nano hello.py</code></pre>
        <p>Zapisz plik poprzez kombinację klawiszy <code>&lt;Ctrl+X&gt;</code>, <code>&lt;Y&gt;</code>, a potem <code>&lt;Enter&gt;</code>.</p>
    </li>
    <li>
        <p>
            Jeśli po raz pierwszy korzystasz z edytora tekstu <code>vi</code>, to bez dodatkowej pomocy lepiej nie próbuj tego najtrudniejszego i zarazem najfajniejszego sposobu edycji plików w systemie Linux. Poniżej pokazano w jaki sposób
            można edytować plik <code>hello.py</code>:
        </p>
        <pre class="shell"><code>15:05 ~ $ cd
15:05 ~ $ vi hello.py</code></pre>
        <p>
            Po otwarciu <code>vi</code> przesuń kursor w dół w miejsce, w którym chcesz dokonać zmiany, i naciśnij klawisz <code>&lt;I&gt;</code> aby przejść do trybu <code>INSERT</code> (jest to tryb wstawiania), następnie wpisz nowy
            tekst, a gdy skończysz, to naciśnij klawisz <code>&lt;Esc&gt;</code>. Aby zapisać plik, wpisz <code>:wq</code>, a następnie wciśnij <code>&lt;Enter&gt;</code>. Jeśli się pogubisz, naciśnij <code>&lt;Esc&gt;</code>, wpisz
            <code>:q!</code> i wciśnij <code>&lt;Enter&gt;</code>, tak aby wyjść z pliku bez zapisywania.
        </p>
    </li>
</ol>
<p>Jeśli znasz jakiś inny edytor tekstu działający z poziomu wiersza poleceń, to oczywiście możesz go używać do edycji plików.</p>


<?php include('footer.php');?>
