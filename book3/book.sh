#! /bin/bash

# EPUB and MOBI versions

cat epub-metadata.txt A0*.mkd 0*.mkd 1*.mkd AA*.mkd AB*.mkd | grep -v '^%' | python2 pre-html.py | python2 verbatim.py | pandoc --default-image-extension=svg --css=stylesheet.css -o x.epub

# make the mobi if it works (add verbose for debugging)
if hash ebook-convert 2>/dev/null; then
    ebook-convert x.epub x.mobi
    echo "mobi generated"
else
    echo "mobi not generated - please install calibre"
fi


# cleanup

rm tmp-1.* tmp-2.* *.tmp *.aux 2> /dev/null

# PDF print version

pandoc A0-preface.mkd -o tmp-1.prefacex.tex
sed < tmp-1.prefacex.tex 's/section{/section*{/' > tmp-1.preface.tex

cat [0-9]*.mkd | python2 verbatim.py | tee tmp-1.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversionprint -V fontsize:10pt -V documentclass:book -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Eksploracja danych z Python 3" --template=template.latex -o tmp-1.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-1.app.tex

sed < tmp-1.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-1.appendix.tex

sed < tmp-1.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-1.sed
diff tmp-1.sed tmp-1.tex
python2 texpatch.py < tmp-1.sed > tmp-1.patch

mv tmp-1.patch tmp-1.tex

pdflatex -shell-escape tmp-1.tex # first, TOC
pdflatex -shell-escape tmp-1.tex # second, add TOC
mv tmp-1.pdf x-1.pdf

# PDF A4

pandoc A0-preface.mkd -o tmp-2.prefacex.tex
sed < tmp-2.prefacex.tex 's/section{/section*{/' > tmp-2.preface.tex

cp 01-intro.mkd 01-intro.mkd.orig
sed -i "3i% Ostatnia aktualizacja: $(date '+%Y-%m-%d')" 01-intro.mkd
cat [0-9]*.mkd | python2 verbatim.py | tee tmp-2.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversiona4  -V fontsize:10pt -V documentclass:book -V papersize:a4paper -V openany -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Eksploracja danych z Python 3" --template=template.latex -o tmp-2.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-2.app.tex
mv 01-intro.mkd.orig 01-intro.mkd

sed < tmp-2.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-2.appendix.tex

sed < tmp-2.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-2.sed
diff tmp-2.sed tmp-2.tex
python2 texpatch.py < tmp-2.sed > tmp-2.patch

mv tmp-2.patch tmp-2.tex

pdflatex -shell-escape tmp-2.tex # first, TOC
pdflatex -shell-escape tmp-2.tex # second, add TOC
mv tmp-2.pdf x-2.pdf

# cleanup

rm ../images/*-eps-converted-to.pdf
rm tmp-1.* tmp-2.*
