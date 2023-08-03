import urllib.request
import json
import ssl

serviceurl = 'https://nominatim.openstreetmap.org/search.php?'

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    address = input('Podaj nazwę miejsca: ')
    if len(address) < 1: break

    parms = dict()
    parms['q'] = address
    parms['format'] = 'geojson'
    parms['limit'] = 1

    url = serviceurl + urllib.parse.urlencode(parms)

    print('Pobieranie', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print('Pobrano:', len(data))

    try:
        js = json.loads(data)
    except:
        js = None

    if not js or 'features' not in js or len(js['features']) == 0:
        print('==== Błąd pobierania ====')
        print(data)
        continue

    print(json.dumps(js, indent=4))

    lng = js['features'][0]['geometry']['coordinates'][0]
    lat = js['features'][0]['geometry']['coordinates'][1]
    print('szer. geogr.', lat, 'dł. geogr.', lng)
    location = js['features'][0]['properties']['display_name']
    print(location)
