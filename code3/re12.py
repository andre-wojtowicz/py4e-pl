# Szukaj linii, które mają postać 'Details:...rev='
# i są zakończone liczbą
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('^Details:.*rev=([0-9]+)', line)
    if len(x) > 0:
        print(x)
