#!/bin/bash

# Clean directory
mkdir -p ../html3
rm ../html3/[0-9]*.php

# Get page titles
mapfile -t titles < <(jq '.modules[].title' ../lessons.json | head -n -1 | nl -n rz -w 2 | sed -e 's/"//g' -e 's/\
t/ - /g' -e 's/$/ - Python dla wszystkich/g')

# Convert all mkd into html
i=0
for fn in [0-9]*.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    cat $fn | \
    python2 pre-html.py | \
    tee tmp.html.pre.$x | \
    python2 verbatim.py --files | \
    tee tmp.html.verbatim.$x | \
    pandoc -s \
    -f markdown -t html \
    --no-highlight \
    --metadata pagetitle="${titles[$i]}" \
    --default-image-extension=svg | \
    tee tmp.html.post.$x | \
    python2 post-html.py | \
    cat > ../html3/$x.php
    i=$i+1
done

sed -i 's~alt="Klasa i dwa obiekty"~alt="Klasa i dwa obiekty" style="width: 50%"~' ../html3/14-objects.php
sed -i 's~alt="Związki między tabelami"~alt="Związki między tabelami" style="width: 50%"~' ../html3/15-database.php
sed -i 's~alt="Łączenie tabel przy pomocy JOIN"~alt="Łączenie tabel przy pomocy JOIN" style="width: 50%"~' ../html3/15-database.php
sed -i 's~alt="Mapa OpenStreetMap"~alt="Mapa OpenStreetMap" style="width: 50%"~' ../html3/16-viz.php
sed -i 's~alt="Algorytm PageRank"~alt="Algorytm PageRank" style="width: 70%"~' ../html3/16-viz.php
sed -i 's~alt="Chmura wyrazów z listy mailingowej deweloperów projektu Sakai"~alt="Chmura wyrazów z listy mailingowej deweloperów projektu Sakai" style="width: 50%"~' ../html3/16-viz.php
sed -i 's~alt="Aktywność mailowa w projekcie Sakai z podziałem na organizacje"~alt="Aktywność mailowa w projekcie Sakai z podziałem na organizacje" style="width: 75%"~' ../html3/16-viz.php

rm tmp.*
