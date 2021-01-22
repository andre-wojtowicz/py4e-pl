import urllib.request
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

conn = sqlite3.connect('friends.sqlite')
cur = conn.cursor()

cur.execute('''CREATE TABLE IF NOT EXISTS Osoby
            (id INTEGER PRIMARY KEY, nazwa TEXT UNIQUE, pobrana INTEGER)''')
cur.execute('''CREATE TABLE IF NOT EXISTS Obserwuje
            (id_od INTEGER, id_do INTEGER, UNIQUE(id_od, id_do))''')

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    acct = input("Podaj nazwę konta na Twitterze lub wprowadź 'koniec': ")
    if (acct == 'koniec'): break
    if (len(acct) < 1):
        cur.execute('SELECT id, nazwa FROM Osoby WHERE pobrana=0 LIMIT 1')
        try:
            (id, acct) = cur.fetchone()
        except:
            print('Nie znaleziono niepobranych kont Twittera')
            continue
    else:
        cur.execute('SELECT id FROM Osoby WHERE nazwa = ? LIMIT 1',
                    (acct, ))
        try:
            id = cur.fetchone()[0]
        except:
            cur.execute('''INSERT OR IGNORE INTO Osoby
                        (nazwa, pobrana) VALUES (?, 0)''', (acct, ))
            conn.commit()
            if cur.rowcount != 1:
                print('Błąd podczas wstawiania konta:', acct)
                continue
            id = cur.lastrowid

    url = twurl.augment(TWITTER_URL, {'screen_name': acct, 'count': '100'})
    print('Pobieranie konta', acct)
    try:
        connection = urllib.request.urlopen(url, context=ctx)
    except Exception as err:
        print('Błąd pobierania', err)
        break

    data = connection.read().decode()
    headers = dict(connection.getheaders())

    print('Pozostało', headers['x-rate-limit-remaining'])

    try:
        js = json.loads(data)
    except:
        print('Błąd parsowania JSONa')
        print(data)
        break

    # Debugowanie
    # print(json.dumps(js, indent=4))

    if 'users' not in js:
        print('Otrzymano nieprawidłowy JSON')
        print(json.dumps(js, indent=4))
        continue

    cur.execute('UPDATE Osoby SET pobrana=1 WHERE nazwa = ?', (acct, ))

    countnew = 0
    countold = 0
    for u in js['users']:
        friend = u['screen_name']
        print(friend)
        cur.execute('SELECT id FROM Osoby WHERE nazwa = ? LIMIT 1',
                    (friend, ))
        try:
            friend_id = cur.fetchone()[0]
            countold = countold + 1
        except:
            cur.execute('''INSERT OR IGNORE INTO Osoby (nazwa, pobrana)
                        VALUES (?, 0)''', (friend, ))
            conn.commit()
            if cur.rowcount != 1:
                print('Błąd podczas wstawiania konta:', friend)
                continue
            friend_id = cur.lastrowid
            countnew = countnew + 1
        cur.execute('''INSERT OR IGNORE INTO Obserwuje (id_od, id_do)
                    VALUES (?, ?)''', (id, friend_id))
    print('Nowe konta=', countnew, ' widziane ponownie=', countold)
    print('Pozostało', headers['x-rate-limit-remaining'])
    conn.commit()
cur.close()
