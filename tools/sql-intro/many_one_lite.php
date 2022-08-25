<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$MAX_UPLOAD_FILE_SIZE = 1024*1024;

require_once "sql_util.php";


$answer = array(
  array(
    "Chase the Ace",
    "AC/DC",
    "Who Made Who",
    "Rock"
  ),
  array(
    "D.T.",
    "AC/DC",
    "Who Made Who",
    "Rock"
  ),
  array(
    "For Those About To Rock (We Salute You)",
    "AC/DC",
    "Who Made Who",
    "Rock"
  )
);

$oldgrade = $RESULT->grade;

if ( isset($_FILES['database']) ) {
    $fdes = $_FILES['database'];

    // Check to see if they left off the file
    if( $fdes['error'] == 4) {
        $_SESSION['error'] = 'Brak pliku; upewnij się, że wybrałeś plik przed wysłaniem rozwiązania';
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $fdes['size'] > $MAX_UPLOAD_FILE_SIZE ) {
        $_SESSION['error'] = "Wgrywany plik musi mieć rozmiar < ".$OUTPUT->displaySize($MAX_UPLOAD_FILE_SIZE);
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( ! endsWith($fdes['name'],'.sqlite') ) {
        $_SESSION['error'] = "Wgrywany plik musi mieć rozszerzenie .sqlite: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }
    $file = $fdes['tmp_name'];


    $fh = fopen($file,'r');
    $prefix = fread($fh, 100);
    fclose($fh);
    if ( ! startsWith($prefix,'SQLite format 3') ) {
        $_SESSION['error'] = "Wgrywany plik nie jest w formacie SQLite3: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $results = false;
    try {
        $db = new SQLite3($file, SQLITE3_OPEN_READONLY);
        $results = @$db->query("
            SELECT Track.title, Artist.name, Album.title, Genre.name
                FROM Track JOIN Genre JOIN Album JOIN Artist
                ON Track.genre_id = Genre.ID and Track.album_id = Album.id
                    AND Album.artist_id = Artist.id
                ORDER BY Artist.name LIMIT 3");
    } catch(Exception $ex) { 
        $_SESSION['error'] = "Błąd SQL: ".$ex->getMessage();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $results === false ) {
        $_SESSION['error'] = "Błąd zapytania SQL: ".$db->lastErrorMsg();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $good = 0;
    $pos = 0;
    while ($row = $results->fetchArray()) {
        $ans = $answer[$pos];
        foreach($ans as $i => $txt ) {
            if ($row[$i] != $txt ) break;
        }
        $good++;
        $pos++;
    }

    if ( $good < 3 ) {
        $_SESSION['error'] = "Niepoprawne dane: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $gradetosend = 1.0;
    $scorestr = "Odpowiedź poprawna, wynik został zapisany.";
    if ( $dueDate->penalty > 0 ) {
        $gradetosend = $gradetosend * (1.0 - $dueDate->penalty);
        $scorestr = "Wynik efektywny = $gradetosend po ".$dueDate->penalty*100.0." procent kary za spóźnienie";
    }
    if ( $oldgrade > $gradetosend ) {
        $scorestr = "Nowy wynik $gradetosend jest mniejszy niż poprzedni wynik $oldgrade, więc poprzedni wynik zostaje zachowany";
        $gradetosend = $oldgrade;
    }

    // Use LTIX to send the grade back to the LMS.
    $debug_log = array();
    $retval = LTIX::gradeSend($gradetosend, false, $debug_log);
    $_SESSION['debug_log'] = $debug_log;

    if ( $retval === true ) {
        $_SESSION['success'] = $scorestr;
    } else if ( is_string($retval) ) {
        $_SESSION['error'] = "Wynik nie został wysłany: ".$retval;
    } else {
        echo("<pre>\n");
        var_dump($retval);
        echo("</pre>\n");
        die();
    }

    // Redirect to ourself
    header('Location: '.addSession('index.php'));
    return;
}

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Twoja aktualna ocena za to zadanie to: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
?>
<p>
<form name="myform" enctype="multipart/form-data" method="post" >
Aby otrzymać punkty za to zadanie, wykonaj poniższe instrukcje i prześlij poniżej plik z bazą SQLite3 (plik musi mieć rozszerzenie <code>.sqlite</code>):<br/>
<input name="database" type="file"> 
<br/>
<input type="submit" value="Wyślij rozwiązanie">
<p>
Nie musisz eksportować ani konwertować bazy; po prostu wyślij utworzony przez Twój program plik <code>.sqlite</code>.
Przejrzyj przykładowy kod, tak aby zobaczyć w jaki sposób użyć funkcji <code>connect()</code>.
</p>
</form>
</p>
<h1>Baza danych dotycząca utworów muzycznych</h1>
<p>
Twoja aplikacja będzie miała za zadanie odczytać wyeksportowany plik iTunes zapisany w formacie XML,
a następnie będzie musiała utworzyć bazę danych o następującej strukturze:
<pre class="sql"><code>CREATE TABLE Artist
(
    id   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    name TEXT UNIQUE
);

CREATE TABLE Genre
(
    id   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    name TEXT UNIQUE
);

CREATE TABLE Album
(
    id         INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    artist_id  INTEGER,
    title      TEXT UNIQUE
);

CREATE TABLE Track
(
    id        INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    title     TEXT UNIQUE,
    album_id  INTEGER,
    genre_id  INTEGER,
    len       INTEGER, 
    rating    INTEGER, 
    count     INTEGER
);</code></pre>
</p>
<p>
Jeśli będziesz uruchamiać swój program kilka razy lub będziesz używać różnych plików wejściowych,
to pamiętaj aby za każdym razem wyczyścić swoją bazę danych.
<p>
Możesz rozpocząć prace nad rozwiązaniem tego zadania zaczynając od analizy i modyfikacji programu zawartego w 
<a href="https://py4e.pl/code3/tracks.zip" target="_blank">
https://py4e.pl/code3/tracks.zip</a>.  
Plik <code>.zip</code> zawiera również plik <code>Library.xml</code>, który jest używany do oceniania poprawności przesyłanych rozwiązań.
Możesz wyeksportować swoje własne utwory z iTunes i utworzyć bazę, ale w celach
zaliczeniowych tego zadania użyj pliku <code>Library.xml</code>, który jest w pliku </code>.zip</code>.
</p>
<p>
Podczas oceny poprawności Twojego rozwiązania, na przesłanej przez Ciebie bazie danych zostanie wywołane poniższe zapytanie SQL, tak aby porównać otrzymane wyniki ze spodziewanymi wynikami:
<pre class="sql"><code>SELECT Track.title,
       Artist.name,
       Album.title,
       Genre.name 
FROM   Track JOIN Genre JOIN Album JOIN Artist 
       ON Track.genre_id = Genre.ID 
          AND Track.album_id = Album.id 
          AND Album.artist_id = Artist.id
ORDER BY Artist.name LIMIT 3;</code></pre>
Spodziewany wynik zapytania na Twojej bazie danych jest następujący (tutaj wyświetlamy to jako prostą tabelę HTML z nagłówkiem):
<table border="2">
<tr>
<th style="padding: 6px;">Track</th><th style="padding: 6px;">Artist</th><th style="padding: 6px;">Album</th><th style="padding: 6px;">Genre</th>
</tr>
<?php
foreach($answer as $ans) {
    echo("<tr>");
    foreach($ans as $i => $txt ) {
        echo("<td style='padding: 6px;'>".htmlentities($txt)."</td>");
    }
    echo("</tr>\n");
}
?>
</table>
</p>
