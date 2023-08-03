Prosty robot internetowy w Pythonie, PageRank stron i wizualizacja

Jest to zestaw programów, które naśladują niektóre z funkcji wyszukiwarki 
internetowej. Programu przechowują swoje dane w bazie danych SQLite o nazwie
'spider.sqlite'. Plik ten może zostać usunięty w dowolnym momencie w celu
ponownego uruchomienia całego procesu budowania rankingu stron.   

Aby móc przeglądać i modyfikować bazę danych, należy zainstalować program
DB Browser for SQLite:

https://sqlitebrowser.org/

Pierwszy program wczytuje stronę internetową i umieszcza serię
stron do bazy danych "spider.sqlite", rejestrując przy tym odnośniki (linki)
pomiędzy stronami. 

Uwaga: Po Windowsem zalecamy korzystać z terminala PowerShell, tak aby nie było 
problemów z wyświetlaniem znaków UTF-8.



python3 spider.py

Wpisz adres internetowy lub wciśnij Enter:   
['https://www.dr-chuck.com']
Ile stron: 25
1 https://www.dr-chuck.com (8386) 4
4 https://www.dr-chuck.com/dr-chuck/resume/index.htm (1855) 9
12 https://www.dr-chuck.com/dr-chuck/resume/pictures/index.htm (1827) 5
...
Ile stron: 



W powyższym przykładowym uruchomieniu wskazaliśmy naszemu robotowi, by sprawdził
domyślną stronę i pobrał 25 stron. Jeśli zrestartujesz program i wskażesz by
przeszukał więcej stron, to nie będzie on ponownie przeszukiwał stron już
znajdujących się w bazie danych. Po ponownym uruchomieniu robot przechodzi do
losowej, niesprawdzonej jeszcze strony i zaczyna tam swoją pracę. Tak więc
każde kolejne uruchomienie "spider.py" jest dodaje tylko nowe strony. 


python3 spider.py

Wpisz adres internetowy lub wciśnij Enter: 
Kontynuowanie istniejącego indeksowania stron. Usuń spider.sqlite, aby rozpocząć nowe indeksowanie.
['https://www.dr-chuck.com']
Ile stron: 3
22 https://www.dr-chuck.com/csev-blog/category/uncategorized (91096) 61
27 https://www.dr-chuck.com/csev-blog/2014/09/how-to-achieve-vendor-lock-in-with-a-legit-open-source-license-affero-gpl (59001) 20
30 https://www.dr-chuck.com/csev-blog/2020/08/styling-tsugi-koseu-lessons (33522) 21
Ile stron:



Możesz mieć wiele punktów startowych w tej samej bazie danych - w programie
nazywane są one "witrynami". Robot internetowy jako następną stronę do
sprawdzenia wybiera losową stronę spośród wszystkich nieodwiedzonych linków na
wszystkich witrynach.

Jeżeli chcesz wyświetlić zawartość bazy, możesz uruchomić "spdump.py": 



python3 spdump.py 

(16, None, 1.0, 2, 'https://www.dr-chuck.com/csev-blog')
(15, None, 1.0, 30, 'https://www.dr-chuck.com/csev-blog/2020/08/styling-tsugi-koseu-lessons')
(15, None, 1.0, 22, 'https://www.dr-chuck.com/csev-blog/category/uncategorized')
...
22 wierszy.



Program dla danej strony pokazuje liczbę przychodzących linków, stary
współczynnik PageRank, nowy współczynnik PageRank, id strony oraz adres URL.
Program "spdump.py" pokazuje tylko te strony, które mają co najmniej jedno
odniesienie z innych stron.

Gdy będziesz już miał kilka stron w swojej bazie danych, to za pomocą programu
"sprank.py" możesz uruchomić algorytm obliczania współczynnika PageRank. Musisz
tylko podać ile iteracji algorytmu program ma wykonać. 



python3 sprank.py 

Ile iteracji: 2
1 0.720326643053916
2 0.34992366601870745
[(1, 0.6196280991735535), (2, 2.4944679374657728), (3, 0.6923553719008263), (4, 1.1014462809917351), (5, 0.2696280991735535)]



Możesz ponownie wyświetlić zawartość bazy aby zobaczyć, że współczynnik
PageRank dla stron został zaktualizowany: 



python3 spdump.py 

(16, 1.0, 2.4944679374657728, 2, 'https://www.dr-chuck.com/csev-blog')
(15, 1.0, 2.1360764832409846, 30, 'https://www.dr-chuck.com/csev-blog/2020/08/styling-tsugi-koseu-lessons')
(15, 1.0, 2.449518442516278, 22, 'https://www.dr-chuck.com/csev-blog/category/uncategorized')
...
22 wierszy.



Możesz uruchamiać "sprank.py" tyle razy, ile chcesz, a program po prostu poprawi
obliczenie współczynnika PageRank za każdym razem, gdy go uruchomisz. Możesz
nawet uruchomić "sprank.py" kilka razy, a następnie dodać kilka kolejnych stron
poprzez "spider.py", a następnie znów uruchomić "sprank.py", by dalej przeliczyć
wartości PageRank. Wyszukiwarka internetowa zazwyczaj przez cały czas uruchamia
zarówno programy do indeksowania stron, jak i do tworzenia rankingu.

Jeżeli chcesz uruchomić obliczenia PageRank od początku bez ponownego przejścia
robotem po stronach, to możesz użyć programu "spreset.py", a następnie możesz
uruchomić ponownie "sprank.py".

Wynik uruchomienia "spreset.py":



python3 spreset.py 

Wszystkie strony mają ustawiony współczynnik PageRank na 1.0



Ponowne uruchomienie "sprank.py":



python3 sprank.py 

Ile iteracji: 50
1 0.720326643053916
2 0.34992366601870745
3 0.17895552923503424
4 0.11665048143652895
...
46 3.579258334100184e-05
47 3.0035450290624035e-05
48 2.520367345856324e-05
49 2.114963873141301e-05
50 1.7747381915049988e-05
[(1, 9.945248881666563e-05), (2, 3.205252622657907), (3, 0.00012907931109952867), (4, 0.0003719906004627465), (5, 9.966636303771006e-05)]



Dla każdej iteracji algorytmu PageRank program wypisuje średnią zmianę
współczynnika na stronę. Początkowo sieć jest dość niezbalansowana, więc
poszczególne wartości rankingu bardzo się zmieniają pomiędzy kolejnymi
iteracjami. Jednak w kilku kolejnych iteracjach algorytm zbiega szybko do
końcowego wyniku. Powinieneś uruchomić "sprank.py" na tyle długo, by kolejne
wartości generowane przez aglorytm nie miały już zbyt dużych różnic.

Jeśli chcesz zwizualizować strony, które aktualnie najwyżej znajdują się w
rankingu, uruchom program "spjson.py". Odczytuje on bazę danych i zapisuje dane
dotyczące najbardziej linkowanych stron w formacie JSON, który może być
obejrzany w przeglądarce internetowej. 



python3 spjson.py 

Tworzenie JSONa w pliku spider.js...
Ile węzłów? 30
Otwórz force.html w przeglądarce internetowej by zobaczyć wizualizację



Możesz obejrzeć wynik otwierając plik "force.html" w swojej przeglądarce
internetowej. Pokazuje on automatyczny układ węzłów (stron) i połączeń między
nimi. Możesz kliknąć i przeciągnąć dowolny węzeł, a także dwukrotnie kliknąć na
węzeł, by wyświetlić adres URL, który jest reprezentowany przez ten węzeł.
Wielkość węzła reprezentuje jego istotność, tzn. że wiele innych stron do
linkuje do tej strony.

Ta wizualizacja jest wykonana przy pomocy układu algorytmu symulacji fizycznej
dostępnego na stronie:

http://mbostock.github.com/d3/

Jeżeli uruchomisz ponownie inne narzędzia tej aplikacji, uruchom ponownie
"spjson.py" i ośwież stronę "force.html" w przeglądarce, tak aby uzyskać nowe
dane umieszczone w "spider.json".
