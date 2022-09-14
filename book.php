<?php include("top.php"); ?>
<?php include("nav.php");?>

<h2>Python dla wszystkich</h2>

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
        <img style="max-width: 150px;" src="book-cover3d.png" />
    </div>
    <div style="text-align: center; margin-top: 3px;">
        <span style="color:#333333; font: normal 12px/17px Arial,Helvetica,sans-serif;">Wersja drukowana:</span>
    </div>
    <div class="book-primary-btn" style="margin-top: 5px; padding: 3px; width: 100%; border-width: 1px 0;">
        <a rel="nofollow" href="https://amzn.to/3eNb3wp" target="_blank" style="text-decoration: none; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; margin: 0; padding: 0; width: 100%; font: normal 14px/17px Arial,Helvetica,sans-serif; color: #333; font-size: 12px; text-align: center; display: flex; justify-content: space-between;">
            <div style=""><img src="book-amz.png" style="height: 20px;" /></div>
            <div style="align-self: center;">miękka oprawa</div>
            <div style="width: 20px"></div>
        </a>
        <a rel="nofollow" href="https://amzn.to/3QM0ZBc" target="_blank" style="text-decoration: none; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; margin: 0; padding: 0; width: 100%; font: normal 14px/17px Arial,Helvetica,sans-serif; color: #333; font-size: 12px; text-align: center; display: flex; justify-content: space-between;">
            <div style=""><img src="book-amz.png" style="height: 20px;" /></div>
            <div style="align-self: center;">twarda oprawa</div>
            <div style="width: 20px"></div>
        </a>
    </div>
</div>

<p>
    Celem książki jest wprowadzenie do tematyki programowania. Szczególny nacisk położono na wykorzystanie Pythona do rozwiązywania podstawowych problemów związanych z danymi, które mogą pojawić się w codziennej pracy.
</p>
<ul>
    <li>
        <a rel="nofollow" href="https://amzn.to/3eNb3wp" target="_blank">Python dla wszystkich: Odkrywanie danych z Python 3</a>:
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

<p>Rozwiązania zadań programistycznych dostępne są w wersji drukowanej (<a href="https://amzn.to/3dee6xq" target="_blank">Amazon</a>) lub w postaci e-booka (<a href="https://leanpub.com/python-dla-wszystkich-rozwiazania" target="_blank">Leanpub</a>).</p>

<p>
Rozdziały 2-10 są mocno zaczerpnięte z otwartej książki zatytułowanej "<a href="https://greenteapress.com/wp/learning-with-python/" target="_blank">Think Python: How to Think like a Computer Scientist</a>" autorstwa
    <a href="https://www.allendowney.com/wp/" target="_blank">Allena B. Downeya</a> i <a href="https://elkner.net/" target="_blank">Jeffa Elknera</a>.
</p>

<?php
include("footer.php");
?>
