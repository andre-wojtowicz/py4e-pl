import sqlite3

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

# Znajdź id, które "wysyłają" współczynnik PageRank - interesują nas tylko strony
# ze składowych silnie spójnych, które mają linki do innych stron i do których
# prowadzą linki z innych stron
cur.execute('''SELECT DISTINCT id_od FROM Linki''')
from_ids = list()
for row in cur: 
    from_ids.append(row[0])

# Znajdź id, które "otrzymują" współczynnik PageRank
to_ids = list()
links = list()
cur.execute('''SELECT DISTINCT id_od, id_do FROM Linki''')
for row in cur:
    from_id = row[0]
    to_id = row[1]
    if from_id == to_id : continue
    if from_id not in from_ids : continue
    if to_id not in from_ids : continue
    links.append(row)
    if to_id not in to_ids : to_ids.append(to_id)

# Uzyskaj najnowsze współczynniki PageRank stron składowej silnie spójnej
prev_ranks = dict()
for node in from_ids:
    cur.execute('''SELECT wsp_nowy FROM Strony WHERE id = ?''', (node, ))
    row = cur.fetchone()
    prev_ranks[node] = row[0]

sval = input('Ile iteracji: ')
many = 1
if ( len(sval) > 0 ) : many = int(sval)

# Sprawdzenie poprawności
if len(prev_ranks) < 1 : 
    print("Nie ma nic do obliczeń PageRank. Sprawdź dane.")
    quit()

# Oblicz PageRank w pamięci aby było szybciej
for i in range(many):
    # print(prev_ranks.items()[:5])
    next_ranks = dict();
    total = 0.0
    for (node, old_rank) in list(prev_ranks.items()):
        total = total + old_rank
        next_ranks[node] = 0.0
    # print(total)

    # Znajdź liczbę wychodzących odnośników i prześlij PageRank dalej 
    # do każdego z nich
    for (node, old_rank) in list(prev_ranks.items()):
        # print(node, old_rank)
        give_ids = list()
        for (from_id, to_id) in links:
            if from_id != node : continue
           #  print('   ',from_id,to_id)

            if to_id not in to_ids: continue
            give_ids.append(to_id)
        if ( len(give_ids) < 1 ) : continue
        amount = old_rank / len(give_ids)
        # print(node, old_rank,amount, give_ids)
    
        for id in give_ids:
            next_ranks[id] = next_ranks[id] + amount
    
    newtot = 0
    for (node, next_rank) in list(next_ranks.items()):
        newtot = newtot + next_rank
    evap = (total - newtot) / len(next_ranks)

    # print(newtot, evap)
    for node in next_ranks:
        next_ranks[node] = next_ranks[node] + evap

    newtot = 0
    for (node, next_rank) in list(next_ranks.items()):
        newtot = newtot + next_rank


    # Obliczy średnią zmianę na stronę starego współczynnika PageRank na nowy 
    # jako wskaźnik zbieżności algorytmu
    totdiff = 0
    for (node, old_rank) in list(prev_ranks.items()):
        new_rank = next_ranks[node]
        diff = abs(old_rank-new_rank)
        totdiff = totdiff + diff

    avediff = totdiff / len(prev_ranks)
    print(i+1, avediff)

    # podmiana
    prev_ranks = next_ranks

# Wprowadzić ostatnie współczynniki PageRank z powrotem do bazy danych
print(list(next_ranks.items())[:5])
cur.execute('''UPDATE Strony SET wsp_stary=wsp_nowy''')
for (id, new_rank) in list(next_ranks.items()) :
    cur.execute('''UPDATE Strony SET wsp_nowy=? WHERE id=?''', (new_rank, id))
conn.commit()
cur.close()

