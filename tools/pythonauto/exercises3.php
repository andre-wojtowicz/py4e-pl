<?php

$EXERCISES =
Array(
"hello" => Array (
"qtext" => "Napisz program, który korzysta z funkcji <code>print()</code>, tak by 
wyświetlić tekst <code>witaj świecie</code>, tak jak pokazano w sekcji <b>Oczekiwany wynik</b>.",
"desired" => "witaj świecie",
"code" => '# poniższy kod prawie działa
prinq("witaj świecie")',
"checks" => Array(
"print" => "Musisz w swoim kodzie użyć funkcji print()."
)),

"loop" => Array (
"qtext" => "Write a program that uses a <b>for</b> loop and the built-in function
<b>range</b> to write out three numbers as shown in 'Desired Output'.",
"desired" => "0
1
2",
"code" => 'print(range(3))',
"checks" => Array(
"for" => "You must produce the numbers using a for loop.",
"print" => "You must use a print statement within the loop.",
"range" => "You should use the range function to generate the list of numbers on the for statement.",
":" => "Your for statement should end with a colon (:) and the following line should be indented"
)),

"2.2" => Array (
"qtext" => "<b>2.2</b> Write a program that uses <b>input</b>
to prompt a user for their name and then
welcomes them.  Note that <b>input</b> will pop up a dialog box.
Enter <b>Sarah</b> in the pop-up box when you are prompted so your
output will match the desired output.",
"desired" => "Hello Sarah",
"code" => '# The code below almost works

name = input("Enter your name")
print("Howdy")',
"checks" => Array(
"input" => "You must prompt for the user's name using the input() function.",
"!Sarah" => "You must actually prompt for the user's name",
"print" => "You must use the print statement to print the line of output."
)),

"2.3" => Array(
"qtext" => "<b>2.3.</b> Napisz program, który będzie prosił użytkownika o podanie liczby godzin oraz stawkę za godzinę i używając danych wejściowych obliczy stosowne wynagrodzenie. Powinieneś użyć <code>input()</code> aby odczytać wprowadzony przez użytkownika napis oraz <code>float()</code> aby przekonwertować go na liczbę. Nie musisz martwić się o sprawdzanie błędów lub niepoprawne dane wprowadzane przez użytkownika.<br/><br/>
Do przetestowania programu wykorzystaj następujące dane wejściowe:
<ul>
<li>liczba godzin: <code>35</code>,</li>
<li>stawka godzinowa: <code>2.75</code>.</li>
</ul>
Obliczone wynagrodzenie powinno wynosić <code>96.25</code>.",
"desired" => "Wynagrodzenie: 96.25",
"code" => '# Udostępniliśmy Tobie pierwszą linię kodu

hrs = input("Podaj liczbę godzin: ")',
"checks" => Array(
"input" => "Musisz poprosić o wprowadzenie liczby godzin i stawki godzinowej przy pomocy funkcji input().",
"print" => "Musisz użyć funkcji print() aby wyświetlić wynik.",
"float" => "Powinieneś użyć funkcji wbudowanej float() aby przekonwertować napis na liczbę zmiennoprzecinkową.",
"*" => "Aby przemnożyć liczbę godzin przez stawkę godzinową użyj operatora '*'.",
"!35" => "Nie powinieneś umieszczać danych wejściowych w kodzie źródłowym programu. Musisz odczytać wartości liczby godzin i stawi godzinowej za pomocą funkcji input().",
"!2.75" => "Nie powinieneś umieszczać danych wejściowych w kodzie źródłowym programu. Musisz odczytać wartości liczby godzin i stawi godzinowej za pomocą funkcji input().",
"!96.25" => "Musisz obliczyć wynagrodzenie.")),


"3.1" => Array(
"qtext" => "<b>3.1.</b> Napisz program, który poprosi użytkownika o podanie liczby godzin oraz stawkę za godzinę pracy, a następnie używając danych wejściowych program obliczy wynagrodzenie. Zapłać normalną stawkę godzinową za maksymalnie 40 godzin i 1,5-krotność stawki godzinowej za wszystkie godziny przepracowane powyżej 40 godzin. Powinieneś użyć <code>input()</code> (aby odczytać wprowadzane dane) oraz <code>float()</code> (aby przekonwertować wprowadzony tekst na liczbę). Nie przejmuj się sprawdzaniem błędów przy wprowadzaniu danych przez użytkownika - załóż, że użytkownik wpisuje liczby prawidłowo.<br/><br/>
Do przetestowania programu wykorzystaj następujące dane wejściowe:
<ul>
<li>liczba godzin: <code>45</code>,</li>
<li>stawka godzinowa: <code>10.50</code>.</li>
</ul>
Obliczone wynagrodzenie powinno wynosić <code>498.75</code>.",
"desired" => "498.75",
"desired2" => "Wynagrodzenie: 498.75",
"code" => 'hrs = input("Podaj liczbę godzin: ")
h = float(hrs)',
"checks" => Array(
"input" => "Musisz poprosić o wprowadzenie liczby godzin i stawki godzinowej przy pomocy funkcji input().",
"print" => "Musisz użyć funkcji print() aby wyświetlić wynik.",
"if" => "Powinieneś użyć instrukcji if, tak aby zdecydować czy wykonać obliczenia dotyczące godzin nadliczbowych.",
"float" => "Powinieneś użyć funkcji wbudowanej float() aby przekonwertować tekst na liczbę zmiennoprzecinkową.",
"!45" => "Musisz odczytać dane wejściowe przy pomocy input(), a następnie je przekonwertować. Liczba '45' nie powinna pojawić się w Twoim programie.",
"!10.5" => "Musisz odczytać dane wejściowe przy pomocy input(), a następnie je przekonwertować.",
"!498" => "Musisz obliczyć wynagrodzenie.")),

"3.3" => Array(
"qtext" => "<b>3.3.</b> Napisz program, który poprosi użytkownika o wartość pomiędzy 0.0 a 1.0. Jeśli wartość jest poza zakresem, wypisz komunikat o błędzie. Jeśli wartość jest między 0.0 a 1.0, wypisz ocenę, korzystając z poniższej tabeli:
<pre>Wartość   Ocena
>= 0.9     5,0
>= 0.8     4,5
>= 0.7     4,0
>= 0.6     3,5
>= 0.5     3,0
 < 0.5     2,0</pre>
Jeśli użytkownik wprowadzi wartość spoza zakresu, wypisz odpowiedni komunikat o błędzie i zakończ działanie programu.
Do przetestowania działania wprowadź wartość 0.75.
",
"desired" => "4,0",
"code" => 'score = input("Podaj wartość: ")',
"checks" => Array(
"input" => "Musisz poprosić o podanie wartości przy pomocy funkcji input().",
"float" => "Powinieneś użyć funkcji wbudowanej float() aby przekonwertować tekst na liczbę zmiennoprzecinkową.",
"print" => "Musisz użyć funkcji print() aby wyświetlić wynik.",
"if" => "Powinieneś użyć instrukcji if aby sprawdzić jaka powinna być ocena na podstawie wprowadzonej wartości.",
"elif" => "Jednym z celów tego zadania jest nauczenie użycia instrukcji elif podczas podejmowania decyzji o ocenie na podstawie wprowadzonej wartości.")
),

"4.6" => Array(
"qtext" => "<b>4.6.</b> Napisz program, który poprosi użytkownika o podanie liczby godzin oraz stawkę za godzinę pracy, a następnie używając danych wejściowych program obliczy wynagrodzenie. Zapłać normalną stawkę godzinową za maksymalnie 40 godzin i 1,5-krotność stawki godzinowej za wszystkie godziny przepracowane powyżej 40 godzin.
Umieść logikę obliczenia wynagrodzenia w funkcji o nazwie <code>computepay()</code>, a następnie użyj tej funkcji. Funkcja powinna zwrócić wartość.
Powinieneś użyć <code>input()</code> (aby odczytać wprowadzane dane) oraz <code>float()</code> (aby przekonwertować wprowadzony tekst na liczbę). Nie przejmuj się sprawdzaniem błędów przy wprowadzaniu danych przez użytkownika - załóż, że użytkownik wpisuje liczby prawidłowo. Nie nazywaj swojej zmiennej o nazwie <code>sum</code> ani nie używaj funkcji <code>sum()</code>.<br/><br/>
Do przetestowania programu wykorzystaj następujące dane wejściowe:
<ul>
<li>liczba godzin: <code>45</code>,</li>
<li>stawka godzinowa: <code>10.50</code>.</li>
</ul>
Obliczone wynagrodzenie powinno wynosić <code>498.75</code>.",
"desired" => "Wynagrodzenie: 498.75",
"code" => 'def computepay(h,r):
    return 42.37

hrs = input("Podaj liczbę godzin: ")
p = computepay(10, 20)
print("Wynagrodzenie:", p)',
"checks" => Array(
"input" => "Musisz poprosić o wprowadzenie liczby godzin i stawki godzinowej przy pomocy funkcji input().",
"print" => "Musisz użyć funkcji print() aby wyświetlić wynik.",
"!45" => "Musisz poprosić użytkownika o wprowadzenie danych.",
"!10.5" => "Musisz poprosić użytkownika o wprowadzenie danych.",
"if" => "Powinieneś użyć instrukcji if, tak aby zdecydować czy wykonać obliczenia dotyczące godzin nadliczbowych.",
"float" => "Powinieneś użyć funkcji wbudowanej float() aby przekonwertować tekst na liczbę zmiennoprzecinkową.",
"def" => "Musisz użyć funkcji o nazwie computepay() do wykonania obliczeń.",
"!sum(" => "Nie nazywaj swojej zmiennej sum ani nie używaj funkcji sum().",
"return" => "Musisz użyć instrukcji return, tak aby przekazać obliczone wynagrodzenie do głównego kodu.",
"computepay" => "Musisz użyć funkcji o nazwie computepay do wykonania obliczeń.",
"!498" => "Musisz obliczyć wynagrodzenie.")
),

"5.2" => Array(
"qtext" => "<b>5.2.</b> Napisz program, który odczytuje liczby całkowite tak długo, aż użytkownik wprowadzi <code>gotowe</code>. Po wpisaniu <code>gotowe</code> wypisz największą i najmniejszą z dotychczas wprowadzonych liczb. Jeśli użytkownik wprowadzi coś innego niż liczbę, obsłuż to przy pomocy <code>try</code>/<code>except</code>, wypisz odpowiedni komunikat i zignoruj wprowadzoną wartość.<br/><br/>
Podczas uruchomienia wprowadź kolejno:
<pre>7
2
bob
10
4
gotowe</pre>
Dopasuj swój wynik do tego, który znajduje się w sekcji <b>Oczekiwany wynik</b>.",
"desired" => "Nieprawidłowe wejście
Największa: 10
Najmniejsza: 2",
"code" => 'largest = None
smallest = None
while True:
    num = input("Wprowadź liczbę: ")
    if num == "gotowe" : break
    print(num)

print("Największa:", largest)',
"checks" => Array(
"input" => "Musisz poprosić o wprowadzenie liczby przy pomocy funkcji input().",
"print" => "Musisz użyć funkcji print() aby wyświetlić wyniki.",
"while" => "Powinieneś użyć instrukcji while do odczytania liczb.",
"int" => "Powinieneś użyć funkcji int() aby przekonwertować tekst na liczbę całkowitą.",
"! 2" => "Powinieneś obliczyć największą i najmniejszą liczbę.",
"!=2" => "Powinieneś obliczyć największą i najmniejszą liczbę.",
"! 10" => "Powinieneś obliczyć największą i najmniejszą liczbę.",
"!=10" => "Powinieneś obliczyć największą i najmniejszą liczbę.",
"try" => "Powinieneś obsłużyć przypadek wprowadzenia niepoprawnych liczb przy pomocy try/except.",
"except" => "Powinieneś obsłużyć przypadek wprowadzenia niepoprawnych liczb przy pomocy try/except.")
),

"6.5" => Array(
"qtext" => "<b>6.5.</b> Napisz kod wykorzystujący funkcję <code>find()</code> i wycinki napisów (patrz: sekcja \"Parsowanie napisów\" w rozdziale 6), tak aby wyodrębnić liczbę znajdującą się na końcu poniższego wiersza. Przekonwertuj wyodrębnioną wartość na liczbę zmiennoprzecinkową i ją wypisz.",
"desired" => "0.8475",
"code" => 'text = "X-DSPAM-Confidence: 0.8475"',
"checks" => Array(
"find" => "Powinieneś użyć funkcji find() do uzyskania pozycji dwukropka w napisie.",
":" => "Powinieneś użyć wycinków napisów [n:m] do wyciągnięcia danych z tekstu.",
"float" => "Powinieneś użyć funkcji float() do konwersji tekstu na liczbę zmiennoprzecinkową.",
'!"0.8475"' =>  "Musisz wyciągnąć dane z napisu.")
),

"fopen" => Array(
"qtext" => 'This Python program opens the file
"mbox-short.txt" and counts the number of lines in the file.',
"desired" => "1910 Lines",
"code" => 'fh = open("mbox-short.txt", "r")

count = 0
for line in fh:
   count = count + 1

print(count,"Lines")
'
),

"7.1" => Array(
"qtext" => "<b>7.1</b> Write a program that prompts for a file name, then opens that file
and reads through the file, and print the contents of the file in upper case.  Use
the file <b>words.txt</b> to produce the output below.".
'<p>
You can download the sample data at
<a href="http://www.py4e.com/code3/words.txt" target="_blank">
http://www.py4e.com/code3/words.txt</a>',
"desired" => "WRITING PROGRAMS OR PROGRAMMING IS A VERY CREATIVE
AND REWARDING ACTIVITY  YOU CAN WRITE PROGRAMS FOR
MANY REASONS RANGING FROM MAKING YOUR LIVING TO SOLVING
A DIFFICULT DATA ANALYSIS PROBLEM TO HAVING FUN TO HELPING
SOMEONE ELSE SOLVE A PROBLEM  THIS BOOK ASSUMES THAT
{\EM EVERYONE} NEEDS TO KNOW HOW TO PROGRAM AND THAT ONCE
YOU KNOW HOW TO PROGRAM, YOU WILL FIGURE OUT WHAT YOU WANT
TO DO WITH YOUR NEWFOUND SKILLS

WE ARE SURROUNDED IN OUR DAILY LIVES WITH COMPUTERS RANGING
FROM LAPTOPS TO CELL PHONES  WE CAN THINK OF THESE COMPUTERS
AS OUR PERSONAL ASSISTANTS WHO CAN TAKE CARE OF MANY THINGS
ON OUR BEHALF  THE HARDWARE IN OUR CURRENT-DAY COMPUTERS
IS ESSENTIALLY BUILT TO CONTINUOUSLY AS US THE QUESTION
WHAT WOULD YOU LIKE ME TO DO NEXT

OUR COMPUTERS ARE FAST AND HAVE VASTS AMOUNTS OF MEMORY AND
COULD BE VERY HELPFUL TO US IF WE ONLY KNEW THE LANGUAGE TO
SPEAK TO EXPLAIN TO THE COMPUTER WHAT WE WOULD LIKE IT TO
DO NEXT IF WE KNEW THIS LANGUAGE WE COULD TELL THE
COMPUTER TO DO TASKS ON OUR BEHALF THAT WERE REPTITIVE
INTERESTINGLY, THE KINDS OF THINGS COMPUTERS CAN DO BEST
ARE OFTEN THE KINDS OF THINGS THAT WE HUMANS FIND BORING
AND MIND-NUMBING",
"code" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
',
"xcode" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
text = fh.read().strip()
print(text.upper())
',
"checks" => Array(
"input" => "You must prompt for the file name using the input() function.",
"open" => "You need to use open() to open the file.",
"print" => "You must use the print statement to print the lines.",
"strip" => "You should use strip() or rstrip() to avoid double newlines.  You may need to scroll down to see a mis-match of the output.",
"upper" => "You should use the upper() function to convert the lines to upper case.")
),

"7.2" => Array(
"qtext" => '<b>7.2.</b> Napisz program proszący o podanie nazwy pliku, a następnie otwórz ten plik i przeszukaj go w celu znalezienia linii podobnych do poniższej:
<pre>
X-DSPAM-Confidence: 0.8475
</pre>
Zliczaj te linie i wyodrębnij z nich wartości zmiennoprzecinkowe, oblicz średnią z tych wartości i wyświetl obliczony wynik. W swoim rozwiązaniu nie używaj funkcji <code>sum()</code> ani zmiennej o nazwie <code>sum</code>.
<p>
Plik testowy możesz pobrać z adresu
<a href="https://py4e.pl/code3/mbox-short.txt" target="_blank">
https://py4e.pl/code3/mbox-short.txt</a>. Podczas testowania swojego programu, jako nazwę pliku do przetworzenia podaj <code>mbox-short.txt</code>.
</p>',
"desired" => "Średni poziom pewności spamu: 0.750718518519",
"code" => '# Użyj mbox-short.txt jako nazwy pliku
fname = input("Podaj nazwę pliku: ")
fh = open(fname)
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:") : continue
    print(line)
print("Gotowe")
',
"xcode" => '# Użyj mbox-short.txt jako nazwy pliku
fname = input("Podaj nazwę pliku: ")
fh = open(fname)
tot = 0.0
count = 0
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:") : continue
    words = line.split()
    tot = tot + float(words[1])
    count = count + 1
print("Średni poziom pewności spamu:", tot/count)
',
"checks" => Array(
"input" => "Musisz poprosić o nazwę pliku przy pomocy funkcji input().",
"open" => "Musisz użyć funkcji open() aby otworzyć plik.",
"!sum" => "Nie używaj funkcji sum() ani nie nadawaj zmiennej nazwy sum.",
"float" => "Powinieneś użyć funkcji float() aby przekonwertować tekst na liczbę zmiennoprzecinkową.",
'!18518' =>  "Musisz pobrać dane z tekstu, a następnie je przekonwertować.",
"/" => "Średnia to suma podzielona przez liczbę elementów.")
),

"8.4" => Array(
"qtext" => '<b>8.4.</b> Otwórz plik <code>romeo.txt</code> i odczytaj go wiersz po wierszu. Każdą linię podziel na listę słów, używając metody <code>split()</code>. Program powinien zbudować listę słów. Dla każdego słowa w każdym wierszu sprawdź, czy słowo jest już na liście, a jeśli nie, to dołącz je do listy. Po zakończeniu programu posortuj i wypisz wynikowe słowa w kolejności alfabetycznej.
<p>
Plik testowy możesz pobrać z adresu
<a href="https://py4e.pl/code3/romeo.txt" target="_blank">
https://py4e.pl/code3/romeo.txt</a>.
</p>',
"desired" => "['Arise', 'But', 'It', 'Juliet', 'Who', 'already', 'and', 'breaks', 'east', 'envious', 'fair', 'grief', 'is', 'kill', 'light', 'moon', 'pale', 'sick', 'soft', 'sun', 'the', 'through', 'what', 'window', 'with', 'yonder']",
"code" => 'fname = input("Podaj nazwę pliku: ")
fh = open(fname)
lst = list()
for line in fh:
print(line.rstrip())
',
"xcode" => 'fname = input("Podaj nazwę pliku: ")
fh = open(fname)
lst = list()
for line in fh:
    words = line.split()
    for word in words:
        if word in lst: continue
        lst.append(word)
lst.sort()
print(lst)
',
"checks" => Array(
"split" => "Powinieneś użyć metody split() aby podzielić linię na wyrazy.",
"append" => "Powinieneś użyć metody append() aby dodać wyraz do listy, o ile go tam jeszcze nie ma.",
"!extend" => "Nie powinieneś używać extend() w tym ćwiczeniu.",
"open" => "Powinieneś użyć funkcji open() aby otworzyć plik.",
"sort" => "Zanim wypiszesz listę, powinieneś użyć metody sort() aby ją posortować.",
"!'yonder'" => "Nie powinieneś umieszczać wynikowych danych w zmiennych znakowych.",
"!.remove(" => "Nie powinieneś używać metody remove().",
"!.set(" => "Nie powinieneś używać metody set()",
"for" => "Potrzebujesz dwie pętle for. Jedna będzie dla obsługi linii, a druga dla każdego słowa w danej linii.")
),

"8.5" => Array(
"qtext" => "<b>8.5.</b> Otwórz plik <code>mbox-short.txt</code> i odczytaj go linia po linii. Gdy trafisz na linię zaczynającą się od <code>'From '</code>, tak jak poniżej:
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
</pre>
to przeparsuj taką linię przy pomocy metody <code>split()</code> i wypisz drugi wyraz z tej linii (t.j. cały adres mailowy osoby, która wysłała wiadomość). Pod koniec działania programu wypisz liczbę wystąpień tego rodzaju linii.
<p>
<b>Wskazówka:</b> upewnij się, że nie uwzględniasz linii, które zaczynają się od <code>'From:'</code>.
</p>".
'<p>
Plik testowy możesz pobrać z adresu
<a href="https://py4e.pl/code3/mbox-short.txt" target="_blank">
https://py4e.pl/code3/mbox-short.txt</a>.',
"desired" => "stephen.marquard@uct.ac.za
louis@media.berkeley.edu
zqian@umich.edu
rjlowe@iupui.edu
zqian@umich.edu
rjlowe@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
gsilver@umich.edu
gsilver@umich.edu
zqian@umich.edu
gsilver@umich.edu
wagnermr@iupui.edu
zqian@umich.edu
antranig@caret.cam.ac.uk
gopal.ramasammycook@gmail.com
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
stephen.marquard@uct.ac.za
louis@media.berkeley.edu
louis@media.berkeley.edu
ray@media.berkeley.edu
cwen@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
Mamy 27 linii w pliku, w których From jest pierwszym wyrazem",
"code" => 'fname = input("Podaj nazwę pliku: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0

print("Mamy", count, "linii w pliku, w których From jest pierwszym wyrazem")
',
"xcode" => 'fname = input("Podaj nazwę pliku: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0
for line in fh:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    print(wds[1])
    count = count + 1
print("Mamy", count, "linii w pliku, w których From jest pierwszym wyrazem")
',
"checks" => Array(
"for" => "Musisz użyć pętli for aby odczytać linie z pliku.",
"split" => "Powinieneś użyć metody split() aby podzielić linię na wyrazy.",
"if" => "Musisz użyć co najmniej jedną instrukcję if aby pominąć linie, które nie zaczynają się od 'From '.",
"open" => "Musisz użyć funkcji open() aby otworzyć plik.")
),

"9.4" => Array(
"qtext" => "<b>9.4.</b> Napisz program, który odczyta zawartość pliku <code>mbox-short.txt</code> i wskaże kto wysłał największą liczbę wiadomości e-mail. Program powinien wyszukiwać wiersze zaczynające się od <code>'From '</code> i wykorzystywać drugie wyrazy z tych wierszy jako osoby, które wysłały wiadomości. W programie utwórz słownik, który odwzorowuje adres e-mail nadawcy na liczbę jego wystąpień w pliku. Po uzupełnieniu słownika, przeszukaj go przy użyciu pętli typu maksymalnej w celu znalezieniu osoby (adresu e-mail), która wystąpiła najwięcej razy.",
"desired" => "cwen@iupui.edu 5",
"code" => 'name = input("Podaj nazwę pliku: ")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Podaj nazwę pliku: ")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    email = wds[1]
    counts[email] = counts.get(email,0) + 1

bigcount = None
bigname = None
for name,count in counts.items():
    if bigname is None or count > bigcount:
        bigname = name
        bigcount = count

print(bigname, bigcount)
',
"checks" => Array(
"for" => "Musisz użyć pętli for aby odczytać linie z pliku.",
"split" => "Powinieneś użyć metody split() aby podzielić linię na wyrazy.",
"!cwen@iupui.edu" => "Musisz użyć pętli for aby odczytać dane z pliku.",
"if" => "Musisz użyć co najmniej jedną instrukcję if aby pominąć linie, które nie zaczynają się od 'From '.",
"open" => "Musisz użyć funkcji open() aby otworzyć plik.")
),

"10.2" => Array(
"qtext" => "<b>10.2.</b> Napisz program, który odczytuje zawartość pliku <code>mbox-short.txt</code> i analizując każdą wiadomość, oblicza rozkład godzin w ciągu dnia. Możesz wyodrębnić godzinę z linii zaczynających się od <code>From </code> (są to napisy związane z czasem do przeanalizowania), a następnie dzieląc tę linię na części za pomocą znaku dwukropka. 
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 <b>09</b>:14:16 2008
</pre>
Gdy już zgromadzisz wartości dla każdej godziny, wypisz zliczenia, po jednym na wiersz, posortowane według godzin.",
"desired" => "04 3
06 1
07 1
09 2
10 3
11 6
14 1
15 2
16 4
17 2
18 1
19 1",
"code" => 'name = input("Podaj nazwę pliku: ")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Podaj nazwę pliku: ")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "Musisz użyć pętli for aby odczytać linie z pliku.",
"sort" => "Musisz użyć metody sort() aby posortować listę po godzinach.")
),

"11.1" => Array (
"qtext" => '<b>11.1</b> Sadly, the autograder does not support the regular expression library.
So please write a program that computes the
<b>Answer to the Ultimate Question of Life, the Universe, and Everything</b>
[<a href="http://www.youtube.com/watch?v=aboZctrHfK8" target="_blank">more detail</a>].
Sample output is below.',
"desired" => "42",
"code" => '',
"checks" => Array(
"print" => "By now you should know that a print statement would be helpful here.",
"*" => "I think that multiplication is involved..."
)),

"11.9" => Array(
"qtext" => "<b>11.9</b> Write a program to prompt the user for a regular expression
and read through the <b>mbox-short.txt</b> and count the number of lines that match
the regular expression using re.search().",
"desired" => "04 3
19 1",
"code" => 'import re

string = input("Enter a regular expression:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open("mbox-short.txt")
count = 0
for line in handle:
    if re.search(string) : count = count + 1
print("mbox-short.txt had ", count, "lines that matched", string)

',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"sort" => "You need to use list sort() method to sort the list of times.")
)


);
