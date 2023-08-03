import sqlite3

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

print("Tworzenie JSONa w pliku spider.js...")
howmany = int(input("Ile węzłów? "))

cur.execute('''SELECT COUNT(id_od) AS linki_przychodzace, wsp_stary, wsp_nowy, id, url 
    FROM Strony JOIN Linki ON Strony.id = Linki.id_do
    WHERE html IS NOT NULL AND blad IS NULL
    GROUP BY id ORDER BY id, linki_przychodzace''')

fhand = open('spider.js','w')
nodes = list()
maxrank = None
minrank = None
for row in cur :
    nodes.append(row)
    rank = row[2]
    if maxrank is None or maxrank < rank: maxrank = rank
    if minrank is None or minrank > rank : minrank = rank
    if len(nodes) > howmany : break

if maxrank == minrank or maxrank is None or minrank is None:
    print("Błąd - uruchom sprank.py aby obliczyć współczynnik PageRank")
    quit()

fhand.write('spiderJson = {"nodes":[\n')
count = 0
map = dict()
ranks = dict()
for row in nodes :
    if count > 0 : fhand.write(',\n')
    # print row
    rank = row[2]
    rank = 19 * ( (rank - minrank) / (maxrank - minrank) ) 
    fhand.write('{'+'"weight":'+str(row[0])+',"rank":'+str(rank)+',')
    fhand.write(' "id":'+str(row[3])+', "url":"'+row[4]+'"}')
    map[row[3]] = count
    ranks[row[3]] = rank
    count = count + 1
fhand.write('],\n')

cur.execute('''SELECT DISTINCT id_od, id_do FROM Linki''')
fhand.write('"links":[\n')

count = 0
for row in cur :
    # print row
    if row[0] not in map or row[1] not in map : continue
    if count > 0 : fhand.write(',\n')
    rank = ranks[row[0]]
    srank = 19 * ( (rank - minrank) / (maxrank - minrank) ) 
    fhand.write('{"source":'+str(map[row[0]])+',"target":'+str(map[row[1]])+',"value":3}')
    count = count + 1
fhand.write(']};')
fhand.close()
cur.close()

print("Otwórz force.html w przeglądarce internetowej by zobaczyć wizualizację")
