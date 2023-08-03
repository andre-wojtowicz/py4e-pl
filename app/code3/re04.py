# Szukaj linii, które zaczynają się od 'From:' i zawierają znak małpy
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('^From:.+@', line):
        print(line)
