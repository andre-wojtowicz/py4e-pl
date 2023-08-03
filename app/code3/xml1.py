import xml.etree.ElementTree as ET

data = '''
<osoba>
  <imie>Chuck</imie>
  <telefon typ="miedzynar">
    +1 734 303 4456
  </telefon>
  <email ukryty="tak" />
</osoba>'''

tree = ET.fromstring(data)
print('Imię:', tree.find('imie').text)
print('Attr:', tree.find('email').get('ukryty'))
