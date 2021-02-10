#! /bin/bash

# EPUB and MOBI versions

cat epub-metadata.txt  <(sed "s/^Copyright 2009– /Copyright 2009–$(date +%Y) /" A0-preface.mkd) 0*.mkd 1*.mkd AA*.mkd AB*.mkd | grep -v '^%' | python2 pre-html.py | python2 verbatim.py | pandoc --default-image-extension=svg --css=stylesheet.css -o x.epub

# make the mobi if it works (add verbose for debugging)
if hash ebook-convert 2>/dev/null; then
    ebook-convert x.epub x.mobi
    echo "mobi generated"
else
    echo "mobi not generated - please install calibre"
fi

# fixer for ingramspark
bash epub-fixer.sh

# cleanup

rm tmp-1.* tmp-2.* tmp-3.* tmp-4.* *.tmp *.aux 2> /dev/null
rm ../images/*-eps-converted-to.pdf 2> /dev/null
rm ../photos/*-eps-converted-to.pdf 2> /dev/null

# PDF print color version

pandoc <(sed "s/^Copyright 2009– /Copyright 2009–$(date +%Y) /" A0-preface.mkd) -o tmp-1.prefacex.tex
sed < tmp-1.prefacex.tex 's/section{/section*{/' > tmp-1.preface.tex

cat [0-9]*.mkd | python2 verbatim.py | tee tmp-1.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversionprint -V fontsize:10pt -V documentclass:book -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Odkrywanie danych z Python 3" -V colorlinks:false -V citecolor:black -V urlcolor:black -V linkcolor:black -V numbersections -V printbook -V typeinclude_t1 --syntax-definition=sql.xml --template=template.latex -o tmp-1.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-1.app.tex

sed < tmp-1.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-1.appendix.tex

sed < tmp-1.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-1.sed
diff tmp-1.sed tmp-1.tex
python2 texpatch.py < tmp-1.sed > tmp-1.patch

perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-1.preface.tex
perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-1.appendix.tex

mv tmp-1.patch tmp-1.tex

perl -0777 -i -pe "s/\\\\href\\{(.+?)\\}\\{(.+?)\\}/\\\\href{\1}{\\\\nolinkurl{\2}}/igs" tmp-1.tex

pdflatex -shell-escape tmp-1.tex # first, TOC
pdflatex -shell-escape tmp-1.tex # second, add TOC
mv tmp-1.pdf x-1.pdf

# cleanup

rm tmp-1.* tmp-2.* tmp-3.* tmp-4.* *.tmp *.aux 2> /dev/null
rm ../images/*-eps-converted-to.pdf 2> /dev/null
rm ../photos/*-eps-converted-to.pdf 2> /dev/null

# PDF print A4

pandoc <(sed "s/^Copyright 2009– /Copyright 2009–$(date +%Y) /" A0-preface.mkd) -o tmp-2.prefacex.tex
sed < tmp-2.prefacex.tex 's/section{/section*{/' > tmp-2.preface.tex

cp 01-intro.mkd 01-intro.mkd.orig
sed -i "3i% Ostatnia aktualizacja: $(date '+%Y-%m-%d')" 01-intro.mkd
cat [0-9]*.mkd | python2 verbatim.py | tee tmp-2.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversiona4  -V fontsize:10pt -V documentclass:book -V papersize:a4paper -V openany -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Odkrywanie danych z Python 3"  -V numbersections -V typeinclude_t2 --template=template.latex --syntax-definition=sql.xml -o tmp-2.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-2.app.tex
mv 01-intro.mkd.orig 01-intro.mkd

sed < tmp-2.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-2.appendix.tex

sed < tmp-2.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-2.sed
diff tmp-2.sed tmp-2.tex
python2 texpatch.py < tmp-2.sed > tmp-2.patch

perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-2.preface.tex
perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-2.appendix.tex

mv tmp-2.patch tmp-2.tex

perl -0777 -i -pe "s/\\\\href\\{(.+?)\\}\\{(.+?)\\}/\\\\href{\1}{\\\\nolinkurl{\2}}/igs" tmp-2.tex

pdflatex -shell-escape tmp-2.tex # first, TOC
pdflatex -shell-escape tmp-2.tex # second, add TOC
mv tmp-2.pdf x-2.pdf

# cleanup

rm tmp-1.* tmp-2.* tmp-3.* tmp-4.* *.tmp *.aux 2> /dev/null
rm ../images/*-eps-converted-to.pdf 2> /dev/null
rm ../photos/*-eps-converted-to.pdf 2> /dev/null

# PDF print b/w version (disabled color syntax highlighting)

pandoc <(sed "s/^Copyright 2009– /Copyright 2009–$(date +%Y) /" A0-preface.mkd) -o tmp-3.prefacex.tex
sed < tmp-3.prefacex.tex 's/section{/section*{/' > tmp-3.preface.tex

cat [0-9]*.mkd | python2 verbatim.py | tee tmp-3.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversionprint -V fontsize:10pt -V documentclass:book -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Odkrywanie danych z Python 3" -V colorlinks:false -V citecolor:black -V urlcolor:black -V linkcolor:black -V numbersections -V printbook --highlight-style=monochrome -V typeinclude_t3 --template=template.latex --syntax-definition=sql.xml -o tmp-3.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-3.app.tex

sed < tmp-3.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-3.appendix.tex

sed < tmp-3.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-3.sed
diff tmp-3.sed tmp-3.tex
python2 texpatch.py < tmp-3.sed > tmp-3.patch

perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-3.preface.tex
perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-3.appendix.tex

mv tmp-3.patch tmp-3.tex

perl -0777 -i -pe "s/\\\\href\\{(.+?)\\}\\{(.+?)\\}/\\\\href{\1}{\\\\nolinkurl{\2}}/igs" tmp-3.tex

pdflatex -shell-escape tmp-3.tex # first, TOC
pdflatex -shell-escape tmp-3.tex # second, add TOC
mv tmp-3.pdf x-3.pdf

gs -o x-3-cmyk.pdf \
    -sDEVICE=pdfwrite \
    -dOverrideICC \
    -sProcessColorModel=DeviceCMYK \
    -sColorConversionStrategy=CMYK \
    -sColorConversionStrategyForImages=CMYK \
     x-3.pdf

##pdfjam --outfile x-3.pdf --papersize '{7in,10in}' x-3-cmyk.pdf
mv x-3-cmyk.pdf x-3.pdf

# cleanup

rm tmp-1.* tmp-2.* tmp-3.* tmp-4.* *.tmp *.aux 2> /dev/null
rm ../images/*-eps-converted-to.pdf 2> /dev/null
rm ../photos/*-eps-converted-to.pdf 2> /dev/null

# PDF electronic A4

pandoc <(sed "s/^Copyright 2009– /Copyright 2009–$(date +%Y) /" A0-preface.mkd) -o tmp-4.prefacex.tex
sed < tmp-4.prefacex.tex 's/section{/section*{/' > tmp-4.preface.tex

cp 01-intro.mkd 01-intro.mkd.orig
sed -i "3i% Ostatnia aktualizacja: $(date '+%Y-%m-%d')" 01-intro.mkd
cat [0-9]*.mkd | python2 verbatim.py | tee tmp-4.verbatim | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V pdfversiona4  -V fontsize:10pt -V documentclass:book -V papersize:a4paper -V openany -V lang:pl-PL -V langbabel:polish -V "author:Dr Charles R. Severance" -V "title:Python dla wszystkich" -V "subtitle:Odkrywanie danych z Python 3"  -V numbersections -V fontcode:lmss  -V typeinclude_t4 --template=template.latex --syntax-definition=sql.xml -o tmp-4.tex
pandoc [A-Z][A-Z]*.mkd -o tmp-4.app.tex
mv 01-intro.mkd.orig 01-intro.mkd

sed < tmp-4.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp-4.appendix.tex

sed < tmp-4.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp-4.sed
diff tmp-4.sed tmp-4.tex
python2 texpatch.py < tmp-4.sed > tmp-4.patch

perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-4.preface.tex
perl -0777 -i -pe "s/\`\`(.+?)''/\\\\enquote{\1}/igs" tmp-4.appendix.tex

mv tmp-4.patch tmp-4.tex

perl -0777 -i -pe "s/\\\\href\\{(.+?)\\}\\{(.+?)\\}/\\\\href{\1}{\\\\nolinkurl{\2}}/igs" tmp-4.tex

pdflatex -shell-escape tmp-4.tex # first, TOC
pdflatex -shell-escape tmp-4.tex # second, add TOC
mv tmp-4.pdf x-4.pdf

# cleanup

rm tmp-1.* tmp-2.* tmp-3.* tmp-4.* *.tmp *.aux 2> /dev/null
rm ../images/*-eps-converted-to.pdf 2> /dev/null
rm ../photos/*-eps-converted-to.pdf 2> /dev/null
