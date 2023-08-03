import sqlite3

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

cur.execute('''SELECT COUNT(id_od) AS linki_przychodzace, wsp_stary, wsp_nowy, id, url 
     FROM Strony JOIN Linki ON Strony.id = Linki.id_do
     WHERE html IS NOT NULL
     GROUP BY id ORDER BY linki_przychodzace DESC''')

count = 0
for row in cur :
    if count < 50 : print(row)
    count = count + 1
print(count, 'wierszy.')
cur.close()
