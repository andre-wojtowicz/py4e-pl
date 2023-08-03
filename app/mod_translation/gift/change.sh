#!/bin/bash

set -ex

if [ ! -d "../../mod/gift/" ]; then
    echo "../../mod/gift/ does not exists"
    exit
fi

cp index.php.sed ../../mod/gift/
cd ../../mod/gift/

if [ ! -f index.php.orig ]; then
    cp index.php index.php.orig
fi

cp index.php.orig index.php

while read line; do
    IFS=';' read -a strarr <<< "$line"
    sed "s~${strarr[0]}~${strarr[1]}~" index.php > index.php.tmp
    retval=$(cmp --silent index.php index.php.tmp; echo $?)
    if [[ $retval -eq 0 ]]; then # no matching
        rm index.php.tmp
        break
    fi
    mv index.php.tmp index.php
done < index.php.sed

sed -i 's~<form method="post">~<form method="post" style="margin-bottom: 20px;">~' index.php
sed -i 's~<input type="submit"~<input type="submit" class="btn btn-default" style="margin-left: 15px;"~' index.php

perl -0777 -i -pe "s/\\$\\('#quiz'\\).append\\(template\\(question\\)\\);(.*?)}/\\$\\('#quiz'\\).append\\(template\\(question\\)\\);\n\t}\n\tdocument.querySelectorAll\\('pre code'\\).forEach\\(\\(block\\)\\ => { hljs.highlightBlock\\(block\\); });\n/igs" index.php

if [ ! -f templates.php.orig ]; then
    cp templates.php templates.php.orig
fi

cp templates.php.orig templates.php

sed -i 's~{{text}}~{{{text}}}~g' templates.php
sed -i 's~<p><input type="checkbox"~<p style="margin-left: 18px;"><input style="margin-left: -18px;" type="checkbox"~' templates.php
sed -i 's~<p><input type="radio"~<p style="margin-left: 18px;"><input style="margin-left: -18px;" type="radio"~' templates.php
sed -i 's~<input type="radio"~<input style="margin-left: -18px;" type="radio"~' templates.php
sed -i 's~<li>~<li style="border-bottom: 1px solid #cccbcb;margin-bottom: 10px;">~' templates.php
