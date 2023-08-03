import urllib.request
import xml.etree.ElementTree as ET
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
    parms['format'] = 'xml'
    parms['limit'] = 1

    url = serviceurl + urllib.parse.urlencode(parms)

    print('Pobieranie', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read()
    print('Pobrano', len(data), 'znaków')

    print(data.decode())

    tree = ET.fromstring(data)

    results = tree.findall('place')
    lat = results[0].get('lat')
    lng = results[0].get('lon')
    location = results[0].get('display_name')

    print('szer. geogr.', lat, 'dł. geogr.', lng)
    print(location)
