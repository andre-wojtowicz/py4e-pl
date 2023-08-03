import sqlite3
import urllib.error
import ssl
from urllib.parse import urljoin
from urllib.parse import urlparse
from urllib.request import urlopen
from bs4 import BeautifulSoup

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

cur.execute('''CREATE TABLE IF NOT EXISTS Strony
    (id INTEGER PRIMARY KEY, url TEXT UNIQUE, html TEXT,
     blad INTEGER, wsp_stary REAL, wsp_nowy REAL)''')

cur.execute('''CREATE TABLE IF NOT EXISTS Linki
    (id_od INTEGER, id_do INTEGER, UNIQUE(id_od, id_do))''')

cur.execute('''CREATE TABLE IF NOT EXISTS WitrynyInternetowe (url TEXT UNIQUE)''')


web = ''
starturl = input('Wpisz adres internetowy lub wciśnij Enter: ')
if ( len(starturl) < 1 ) :
    # Sprawdź, czy już jesteśmy w trakcie działania...
    cur.execute('SELECT id, url FROM Strony WHERE html IS NULL AND blad IS NULL ORDER BY RANDOM() LIMIT 1')
    row = cur.fetchone()
    if row is not None:
        print("Kontynuowanie istniejącego indeksowania stron. Usuń spider.sqlite, aby rozpocząć nowe indeksowanie.")
    else:
        starturl = 'https://www.dr-chuck.com/'

if ( starturl.endswith('/') ) : starturl = starturl[:-1]
web = starturl
if ( starturl.endswith('.htm') or starturl.endswith('.html') ) :
    pos = starturl.rfind('/')
    web = starturl[:pos]

if ( len(web) > 1 ) :
    cur.execute('INSERT OR IGNORE INTO WitrynyInternetowe (url) VALUES ( ? )', ( web, ) )
    cur.execute('INSERT OR IGNORE INTO Strony (url, html, wsp_nowy) VALUES ( ?, NULL, 1.0 )', ( starturl, ) )
    conn.commit()

# Pobierz aktualne witryny internetowe
cur.execute('''SELECT url FROM WitrynyInternetowe''')
webs = list()
for row in cur:
    webs.append(str(row[0]))

print(webs)

many = 0
while True:
    if ( many < 1 ) :
        sval = input('Ile stron: ')
        if ( len(sval) < 1 ) : break
        many = int(sval)
    many = many - 1

    cur.execute('SELECT id, url FROM Strony WHERE html IS NULL AND blad is NULL ORDER BY RANDOM() LIMIT 1')
    try:
        row = cur.fetchone()
        # print(row)
        fromid = row[0]
        url = row[1]
    except:
        print('Nie znaleziono żadnych niepobranych stron HTML')
        many = 0
        break

    print(fromid, url, end=' ')

    # Jeśli pobieramy tę stronę, nie powinno być z niej żadnych odnośników.
    cur.execute('DELETE FROM Linki WHERE id_od=?', (fromid, ) )
    try:
        document = urlopen(url, context=ctx)

        html = document.read()
        if document.getcode() != 200 :
            print("Błąd na stronie: ",document.getcode())
            cur.execute('UPDATE Strony SET blad=? WHERE url=?', (document.getcode(), url) )

        if 'text/html' != document.info().get_content_type() :
            print("Ignorowanie stron innych niż text/html")
            cur.execute('DELETE FROM Strony WHERE url=?', ( url, ) )
            conn.commit()
            continue

        print('('+str(len(html))+')', end=' ')

        soup = BeautifulSoup(html, "html.parser")
    except KeyboardInterrupt:
        print('')
        print('Program przerwany przez użytkownika...')
        break
    except:
        print("Nie można pobrać lub przetworzyć strony")
        cur.execute('UPDATE Strony SET blad=-1 WHERE url=?', (url, ) )
        conn.commit()
        continue

    cur.execute('INSERT OR IGNORE INTO Strony (url, html, wsp_nowy) VALUES ( ?, NULL, 1.0 )', ( url, ) )
    cur.execute('UPDATE Strony SET html=? WHERE url=?', (memoryview(html), url ) )
    conn.commit()

    # Odzyskaj wszystkie znaczniki HTML z adresami URL
    tags = soup('a')
    count = 0
    for tag in tags:
        href = tag.get('href', None)
        if ( href is None ) : continue
        # Rozwiąż odniesienia względne, takich jak href="/contact"
        up = urlparse(href)
        if ( len(up.scheme) < 1 ) :
            href = urljoin(url, href)
        ipos = href.find('#')
        if ( ipos > 1 ) : href = href[:ipos]
        if ( href.endswith('.png') or href.endswith('.jpg') or href.endswith('.gif') ) : continue
        if ( href.endswith('/') ) : href = href[:-1]
        # print(href)
        if ( len(href) < 1 ) : continue

		# Sprawdź, czy adres URL znajduje się w którejkolwiek ze stron internetowych
        found = False
        for web in webs:
            if ( href.startswith(web) ) :
                found = True
                break
        if not found : continue

        cur.execute('INSERT OR IGNORE INTO Strony (url, html, wsp_nowy) VALUES ( ?, NULL, 1.0 )', ( href, ) )
        count = count + 1
        conn.commit()

        cur.execute('SELECT id FROM Strony WHERE url=? LIMIT 1', ( href, ))
        try:
            row = cur.fetchone()
            toid = row[0]
        except:
            print('Nie moża uzyskać id')
            continue
        # print(fromid, toid)
        cur.execute('INSERT OR IGNORE INTO Linki (id_od, id_do) VALUES ( ?, ? )', ( fromid, toid ) )


    print(count)

cur.close()
