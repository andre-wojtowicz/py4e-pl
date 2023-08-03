#!/bin/bash

set -ex

if [ ! -d "../../mod/peer-grade/" ]; then
    echo "../../mod/peer-grade/ does not exists"
    exit
fi

cp index.php.sed ../../mod/peer-grade/
cp peer_util.php.sed ../../mod/peer-grade/
cd ../../mod/peer-grade/

if [ ! -f index.php.orig ]; then
    cp index.php index.php.orig
fi
if [ ! -f peer_util.php.orig ]; then
    cp peer_util.php peer_util.php.orig
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

sed -i 's~<div style="border: 1px solid black">~<div>~' index.php

cp peer_util.php.orig peer_util.php

while read line; do
    IFS=';' read -a strarr <<< "$line"
    sed "s~${strarr[0]}~${strarr[1]}~g" peer_util.php > peer_util.php.tmp
    retval=$(cmp --silent peer_util.php peer_util.php.tmp; echo $?)
    if [[ $retval -eq 0 ]]; then # no matching
        rm peer_util.php.tmp
        break
    fi
    mv peer_util.php.tmp peer_util.php
done < peer_util.php.sed
