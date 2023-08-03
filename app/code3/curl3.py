import os
import urllib.request

print('Podaj adres URL podobny do http://data.pr4e.org/cover3.jpg')
urlstr = input().strip()
img = urllib.request.urlopen(urlstr)

# Pobierz ostatnie "słowo"
words = urlstr.split('/')
fname = words[-1]

# Nie nadpisuj pliku
if os.path.exists(fname):
    if input('Nadpisać ' + fname + ' (T/n)?') != 'T':
        print('Dane nie zostały skopiowane')
        exit()
    print('Nadpisywanie', fname)

fhand = open(fname, 'wb')
size = 0
while True:
    info = img.read(100000)
    if len(info) < 1: break
    size = size + len(info)
    fhand.write(info)

print('Skopiowano', size, 'znaków do', fname)
fhand.close()
