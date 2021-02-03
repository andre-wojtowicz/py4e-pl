<?php include("top.php"); ?>
<?php include("nav.php");?>

<h2>Python dla wszystkich</h2>

<div style="float: right; border-left:0px; border-right:0px; border-bottom:0px; max-width:200px; border-top: 2px solid #f90; padding: 8px 0; margin: 0; line-height: 11px;">
    <div style="text-align: center;">
        <img style="max-width: 200px;" src="cover3-final-pl.jpg" />
    </div>
</div>

<p>
    Celem książki jest wprowadzenie do tematyki programowania. Szczególny nacisk położono na wykorzystanie Pythona do rozwiązywania podstawowych problemów związanych z danymi, które mogą pojawić się w codziennej pracy.
</p>
<ul>
    <li>
        Polskie tłumaczenie:
        <ul class="menu vertical nested is-active">
            <li class="menu-text">ostatnia aktualizacja: <?php exec('git log -1 --format="%at" | xargs -I{} date -d @{} "+%Y-%m-%d"', $commit_date); echo($commit_date[0]); ?></li>
            <li class="menu-text">
                do czytania na ekranie: <a href="html3">HTML</a>, <a href="translations/PL/py4e-pl-a4-online-latest.pdf" target="_blank">PDF</a>, <a href="translations/PL/py4e-pl-latest.epub" target="_blank">EPUB</a>, <a href="translations/PL/py4e-pl-latest.mobi" target="_blank">MOBI</a>
            </li>
            <li class="menu-text">
                do druku (PDF): <a href="translations/PL/py4e-pl-a4-latest.pdf" target="_blank">A4 kolor</a>, <a href="translations/PL/py4e-pl-print-latest.pdf" target="_blank">7 × 10 " kolor</a>, <a href="translations/PL/py4e-pl-print-bw-latest.pdf" target="_blank">7 × 10 " czarno-biały</a>
            </li>
            <li class="menu-text"><a href="https://github.com/andre-wojtowicz/py4e-pl" target="_blank">Kod źródłowy książki na GitHubie</a> (zmiany w repozytorium powodują automatyczne przebudowanie ww. plików)</li>
        </ul>
        <p>Współtwórcy: <a href="https://github.com/andre-wojtowicz" target="_blank">Andrzej Wójtowicz</a></p>
    </li>
    <li>
        <a href="https://www.py4e.com/book">Inne języki</a>
    </li>
</ul>

<p>Wykorzystywane w książce przykładowe kody programów oraz pliki danych znajdują się w katalogu <a href="code3" target="_blank">code3</a>.</p>

<p>Slajdy do wykładów znajdują się w katalogu <a href="lectures3" target="_blank">lectures3</a>.</p>

<p>Materiały uzupełniające dotyczące ćwiczeń programistycznych znajdują się w serwisie <a href="https://leanpub.com/python-dla-wszystkich-rozwiazania" target="_blank">Leanpub</a>.</p>

<p>
Rozdziały 2-10 są mocno zaczerpnięte z otwartej książki zatytułowanej "<a href="https://greenteapress.com/wp/learning-with-python/" target="_blank">Think Python: How to Think like a Computer Scientist</a>" autorstwa
    <a href="https://www.allendowney.com/wp/" target="_blank">Allena B. Downeya</a> i <a href="https://elkner.net/" target="_blank">Jeffa Elknera</a>.
</p>

<?php
include("footer.php");
?>
