#!/bin/bash

zipedit_nav(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    sed -i 's~python-dla-wszystkich">Python dla wszystkich</a>~python-dla-wszystkich">Strona redakcyjna</a>~' "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

zipedit_toc(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    sed -i ':a;N;$!ba;s~<text>Python dla wszystkich</text>~<text>Strona redakcyjna</text>~3' "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

zipedit_red(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    sed -i 's~<h1>Python dla wszystkich</h1>~<h1>Strona redakcyjna</h1>\n<h3>Python dla wszystkich. Odkrywanie danych z Python 3</h3>~' "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

zipedit_xhtml(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    sed -i -E 's/height="([0-9]+)"//g' "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

zipedit_svg(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    sed -i '2d' "$2"
    sed -i 's/xl:href/href/' "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

zipedit_flowroot(){
    curdir=$(pwd)
    unzip "$1" "$2" -d /tmp 
    cd /tmp
    pcregrep -v -M '<flowRoot(\n|.)*?flowRoot>' "$2" > "$2".new
    mv "$2".new "$2"
    zip --update "$curdir/$1"  "$2" 
    # remove this line to just keep overwriting files in /tmp
    rm -f "$2" # or remove -f if you want to confirm
    cd "$curdir"
}

epubfile=x.epub

zipedit_nav $epubfile EPUB/nav.xhtml
zipedit_toc $epubfile EPUB/toc.ncx
zipedit_red $epubfile EPUB/text/ch001.xhtml

zipedit_xhtml $epubfile EPUB/text/ch004.xhtml

zipedit_svg $epubfile EPUB/media/file11.svg
zipedit_svg $epubfile EPUB/media/file12.svg
zipedit_svg $epubfile EPUB/media/file2.svg
zipedit_svg $epubfile EPUB/media/file21.svg
zipedit_svg $epubfile EPUB/media/file3.svg
zipedit_svg $epubfile EPUB/media/file4.svg
zipedit_svg $epubfile EPUB/media/file6.svg
zipedit_svg $epubfile EPUB/media/file7.svg

zipedit_flowroot $epubfile EPUB/media/file22.svg
zipedit_flowroot $epubfile EPUB/media/file23.svg
