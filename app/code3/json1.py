import json
data = '''{
  "imie" : "Chuck",
  "telefon" : {
    "typ" : "miedzynar",
    "numer" : "+1 734 303 4456"
   },
   "email" : {
     "ukryty" : "tak"
   }
}'''

info = json.loads(data)
print('Imię:', info["imie"])
print('Ukryty:', info["email"]["ukryty"])
