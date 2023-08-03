Analiza archiwum mailowego Gmane i wizualizacja danych przy użyciu
biblioteki JavaScript D3

Poniższa aplikacja zawiera programy, które pozwalają na pobranie i 
przetworzenie wiadomości umieszczonych na liście mailingowej projektu
Sakai. Aby nie obciążać innych serwerów, kopia wiadomości dostępna
jest pod adresem:

Aby móc przeglądać i modyfikować bazę danych, należy zainstalować program
DB Browser for SQLite:

https://sqlitebrowser.org/

Pierwszym krokiem jest przeskanowanie repozytorium Gmane. Główny adres URL jest 
zapisany w gmane.py wzmiennej baseurl i wskauzje na listę mailingową deweloperów
projektu Sakai. Twój robot może skanować inne repozytorium - wystarczy, że 
zmienisz wspomniany adres adres URL. Jeśli zmienisz adres URL, to skasuj również
plik content.sqlite.

Na dobry początek, pod poniższym linkiem umieściłem 600MB pierwszych wiadomości
mailowych:

https://www.py4e.com/data_space/content.sqlite.zip

Jeśli pobierzesz ten plik, to uruchamiając gmane.py będziesz musiał pobrać
dodatkowo tylko najnowsze wiadomości.

Przejdź do katalogu gdzie rozpakowałeś gmane.zip

Uwaga: Po Windowsem zalecamy korzystać z terminala PowerShell, tak aby nie było 
problemów z wyświetlaniem znaków UTF-8.

Oto wynik uruchomienia gmane.py, który pobiera dziesięć ostatnich wiadomości z
listy deweloperów projektu Sakai: 



python3 gmane.py 

Ile wiadomości: 10
http://mbox.dr-chuck.net/sakai.devel/59643/59644 17553
    matthew@longsight.com 2015-03-20T16:27:12-04:00 re: [building sakai] sakai 10 bulding error
http://mbox.dr-chuck.net/sakai.devel/59644/59645 13128
    alberto.olivamolina@gmail.com 2015-03-20T16:36:12+01:00 re: [building sakai] sakai 10 bulding error
http://mbox.dr-chuck.net/sakai.devel/59645/59646 7557
    eric.duquenoy@univ-littoral.fr 2015-03-20T16:52:24+01:00 [building sakai] lti and sakai groups (or sections)
http://mbox.dr-chuck.net/sakai.devel/59646/59647 1
...



Program skanuje zawartość content.sqlite w poszukiwaniu numeru pierwszej
niepobranej jeszcze wiadomości. Robot ściąga dane tak długo aż nie pobierze
pożądanej liczby wiadomości lub gdy dotrze do strony, która nie wydaje się być
odpowiednio sformatowaną wiadomością.

Czasami może brakować pewnych wiadomości. Być może administratorzy Gmane mogli
usuwać wiadomości, a może się te wiadomości gdzieś przepadły. Jeżeli Twój robot
się zatrzyma, a wydaje się, że trafił na właśnie taką brakującą wiadomość, to
przejdź do przeglądarki bazy SQLite i dodaj wiersz z brakującym id, 
pozostawiając wszystkie pozostałe pola puste, a następnie uruchom ponownie 
gmane.py. Dzięki temu robot będzie mógł kontynuować pracę. Wstawione ręcznie 
puste wiadomości będą ignorowane w następnej fazie procesu.

Jedną z przyjemnych w tym wszystkim rzeczy jest to, że gdy już pobierzesz 
wszystkie wiadomości i będziesz je miał w content.sqlite, to po jakimś czasie 
będziesz mógł ponownie uruchomić gmane.py, po to by uzyskać tylko nowe 
wiadomości, które zostały ostatnio wysłane na listę mailingową.

Dane zawarte w bazie content.sqlite są dość surowe, z niewydajnym modelem 
danych, a ponadto nie są skompresowane. Jest to celowe, ponieważ pozwala Ci 
oberzeć plik content.sqlite w przeglądarce bazy SQLite by usunąć problemy 
związane procesem pobierania danych. Generalnie byłby to zły pomysł aby 
uruchomić jakiekolwiek zapytanie SQL na tej bazie danych, ponieważ jego 
wykonanie byłyby dość powolne.

Druga faza polega na uruchomieniu programu gmodel.py. Program ten odczytuje 
surowe dane z content.sqlite i tworzy w pliku index.sqlite oczyszczoną i dobrze 
zamodelowaną wersję danych. Plik ten będzie znacznie mniejszy (często ok. 10 
razy mniejszy) niż content.sqlite, ponieważ kompresuje on również nagłówek i 
treść wiadomości.

Za każdym razem gdy uruchomimy gmodel.py, program usuwa i przebudowuje plik 
index.sqlite, pozwalając Ci dostosować jego parametry i edytować tabele 
mapowania w content.sqlite, tak aby dopasować odpowiednio proces czyszczenia 
danych.

Uruchomienie gmodel.py wygląda następująco:



python3 gmodel.py

Załadowano nadawców: 1588 , mapowania: 29 , mapowania dns: 1
1 2005-12-08T23:34:30-06:00 ggolden22@mac.com
251 2005-12-22T10:03:20-08:00 tpamsler@ucdavis.edu
501 2006-01-12T11:17:34-05:00 lance@indiana.edu
751 2006-01-24T11:13:28-08:00 vrajgopalan@ucmerced.edu
...



Program gmodel.py realizuje szereg zadań związanych z czyszczeniem danych.

Nazwy domen są obcięte do dwóch poziomów dla domen .com, .org, .edu i .net. 
Inne nazwy domen są obcięte do trzech poziomów. Tak więc si.umich.edu staje się 
umich.edu, a caret.cam.ac.uk staje się cam.ac.uk. Adresy e-mail są również 
wymuszone na zapis małymi literami, a niektóre z adresów @gmane.org jak np.

   arwhyte-63aXycvo3TyHXe+LvDLADg@public.gmane.org

są konwertowane na rzeczywisty adres za każdym razem, gdy w korpusie wiadomości 
znajduje się odpowiadający mu rzeczywisty adres e-mail.

W bazie danych mapping.sqlite znajdują się dwie tabele, które pozwalają na 
mapowanie zarówno nazw domen, jak i poszczególnych adresów e-mail, które 
zmieniają się w ciągu całego okresu życia listy mailingowej. Na przykład, Steve 
Githens użył następujących adresów e-mail, ponieważ zmieniał pracę w ciągu 
całego życia listy mailingowej deweloperów projektu Sakai: 

s-githens@northwestern.edu
sgithens@cam.ac.uk
swgithen@mtu.edu

Jeśli chcemy, to możemy w mapping.sqlite do tabeli mapowania nadawców Mapping 
dodać dwa wpisy, tak by gmodel.py mapował wszystkie trzy adresy na jeden adres: 

s-githens@northwestern.edu ->  swgithen@mtu.edu
sgithens@cam.ac.uk -> swgithen@mtu.edu

And so all the mail messages will be collected under one sender even if 
they used several email addresses over the lifetime of the mailing list.

Jeżeli istnieje wiele nazw DNS, które chcesz zmapować na jeden DNS, to możesz 
również dokonać podobnych wpisów w tabeli DNSMapping. Przykładowo:

iupui.edu -> indiana.edu

dzięki czemu wszystkie konta z różnych kampusów Uniwersytetu Indiany są śledzone 
razem.

Możesz uruchamiać gmodel.py wielokrotnie, za każdym razem gdy spojrzysz na dane 
i dodasz mapowania, tak by dane do analizy były czystsze i bardziej przejrzyste. 
Kiedy skończysz, w pliku index.sqlite będziesz miał ładnie zaindeksowaną wersję 
e-maili. Jest to plik, którego możesz użyć do dalszej analizy danych. Z tym 
plikiem analiza będzie naprawdę szybka.

Pierwszą, najprostszą analizą jest określenie "kto wysłał najwięcej wiadomości?" 
i "która organizacja wysłała najwięcej listów"? Odpowiedzi na te pytania 
uzyskamy za pomocą progrmau gbasic.py: 



python3 gbasic.py 

Ile wyświetlić? 5
Załadowanych wiadomości= 51330 tematów= 25033 nadawców= 1584

Lista 5 najczęstszych użytkowników
steve.swinsburg@gmail.com 2657
azeckoski@unicon.net 1742
ieb@tfd.co.uk 1591
csev@umich.edu 1304
david.horwitz@uct.ac.za 1184

Lista 5 najczęstszych organizacji
gmail.com 7339
umich.edu 6243
uct.ac.za 2451
indiana.edu 2258
unicon.net 2055



Możesz zajrzeć do danych w index.sqlite i jeśli znajdziesz tam jakiś problem, to 
możesz w mapping.sqlite zaktualizować tabelę Mapping oraz tabelę DNSMapping, a 
następnie ponownie uruchom gmodel.py

Poprzez program gword.py możesz stworzyć prostą wizualizację częstości 
występowania słów w tematach wiadomości: 



python3 gword.py

Zakres częstości: 33229 129
Wynik zapisano w gword.js
Otwórz gword.htm w przeglądarce internetowej by zobaczyć wizualizcję



W ten sposób powstaje plik gword.js, który możesz zwizualizować za pomocą 
gword.htm. 

Druga wizualizacja jest tworzona przez program gline.py. Oblicza ona udział 
organizacji w wiadomościach mailowych w danym czasie. 



python3 gline.py

Loaded messages= 51330 subjects= 25033 senders= 1584
Top 10 organizacji
['gmail.com', 'umich.edu', 'uct.ac.za', 'indiana.edu',
'unicon.net', 'tfd.co.uk', 'berkeley.edu', 'longsight.com',
'stanford.edu', 'ox.ac.uk']
Wynik zapisano w gline.js
Otwórz gline.htm by zwizualizować dane



Wynik jest zapisywany w pliku gline.js, który można zwizualizować przy użyciu 
strony gline.htm.

Poniżej znajduje się kilka adresów URL dotyczące pomysłów na wizualizacje:

https://developers.google.com/chart/

https://developers.google.com/chart/interactive/docs/gallery/motionchart

https://code.google.com/apis/ajax/playground/?type=visualization#motion_chart_time_formats

https://developers.google.com/chart/interactive/docs/gallery/annotatedtimeline

http://bost.ocks.org/mike/uberdata/

http://mbostock.github.io/d3/talk/20111018/calendar.html

http://nltk.org/install.html

Jak zawsze - komentarze mile widziane.

-- Dr. Chuck
Sun Sep 29 00:11:01 EDT 2013

