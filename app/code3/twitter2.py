import urllib.request
import twurl
import json
import ssl

# https://developer.twitter.com/en/apps
# Utwórz aplikację i wstaw w hidden.py cztery ciągi znaków dotyczące OAuth

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print('')
    acct = input('Podaj nazwę konta na Twitterze: ')
    if (len(acct) < 1): break
    url = twurl.augment(TWITTER_URL,
                        {'screen_name': acct, 'count': '5'})
    print('Pobieranie', url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()

    js = json.loads(data)
    print(json.dumps(js, indent=2))

    headers = dict(connection.getheaders())
    print('Pozostało', headers['x-rate-limit-remaining'])

    for u in js['users']:
        print(u['screen_name'])
        if 'status' not in u:
            print('   * Nie odnaleziono klucza "status"')
            continue
        s = u['status']['text']
        print('  ', s[:50])
