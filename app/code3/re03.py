# Wyszukaj linie zaczynające się od 'F',
# po których następują 2 dowolne znaki,
# a następnie 'm:'.
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('^F..m:', line):
        print(line)
