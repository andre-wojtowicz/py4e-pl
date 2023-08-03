from urllib.request import urlopen
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

cur.execute('''
            CREATE TABLE IF NOT EXISTS Twitter
            (nazwa TEXT, pobrany INTEGER, znajomi INTEGER)''')

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    acct = input("Podaj nazwę konta na Twitterze lub wprowadź 'koniec': ")
    if (acct == 'koniec'): break
    if (len(acct) < 1):
        cur.execute('SELECT nazwa FROM Twitter WHERE pobrany = 0 LIMIT 1')
        try:
            acct = cur.fetchone()[0]
        except:
            print('Nie znaleziono niepobranych kont Twittera')
            continue

    url = twurl.augment(TWITTER_URL, {'screen_name': acct, 'count': '20'})
    print('Pobieranie', url)
    connection = urlopen(url, context=ctx)
    data = connection.read().decode()
    headers = dict(connection.getheaders())

    print('Pozostało', headers['x-rate-limit-remaining'])
    js = json.loads(data)
    # Debugowanie
    # print json.dumps(js, indent=4)

    cur.execute('UPDATE Twitter SET pobrany=1 WHERE nazwa = ?', (acct, ))

    countnew = 0
    countold = 0
    for u in js['users']:
        friend = u['screen_name']
        print(friend)
        cur.execute('SELECT znajomi FROM Twitter WHERE nazwa = ? LIMIT 1',
                    (friend, ))
        try:
            count = cur.fetchone()[0]
            cur.execute('UPDATE Twitter SET znajomi = ? WHERE nazwa = ?',
                        (count+1, friend))
            countold = countold + 1
        except:
            cur.execute('''INSERT INTO Twitter (nazwa, pobrany, znajomi)
                        VALUES (?, 0, 1)''', (friend, ))
            countnew = countnew + 1
    print('Nowe konta=', countnew, ' widziane ponownie=', countold)
    conn.commit()

cur.close()
