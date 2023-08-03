#!/bin/bash

set -ex

cd book3
bash book.sh
mapfile -t nums < <(pdftk ../translations/PL/py4e-pl-a4-online-latest.pdf dump_data_utf8 | pcregrep -M '^Bookmark(.*)\nBookmarkLevel: 1\nBookmarkPageNumber:(.*)' | grep 'BookmarkPageNumber.*' | tail -n +3 | head -n -2 | sed -E 's/BookmarkPageNumber: (.*)/\1/g')
for n in $(seq 0 $((${#nums[@]}-2)))
do
    idx_from=${nums[n]}
    idx_to=$((${nums[$((n+1))]}-1))
    idx_file=$(printf "%02d" $((n+1)))
    pdftk ../translations/PL/py4e-pl-a4-online-latest.pdf cat ${idx_from}-${idx_to} output ../translations/PL/${idx_file}-py4e-pl-x.pdf
    tmpfile=$(mktemp) && paps <(echo -e "Poniższy rozdział pochodzi z książki:\n\nCharles R. Severance - \"Python dla wszystkich: Odkrywanie danych z Python 3\"\n\nPełna wersja podręcznika znajduje się na stronie https://py4e.pl/book") --font="Monospace 10" | ps2pdf - "$tmpfile" && qpdf ../translations/PL/${idx_file}-py4e-pl-x.pdf --overlay "$tmpfile" -- ../translations/PL/${idx_file}-py4e-pl.pdf && rm -f $tmpfile ../translations/PL/${idx_file}-py4e-pl-x.pdf
done
bash phpbook.sh
cd ..
rm -f code3.zip
rm -f code3/geodata.zip
rm -f code3/pagerank.zip
rm -f code3/gmane.zip
rm -f code3/tracks.zip
zip -r code3.zip code3
cd code3
zip -r geodata.zip geodata
zip -r pagerank.zip pagerank
zip -r gmane.zip gmane
zip -r tracks.zip tracks
cd ..