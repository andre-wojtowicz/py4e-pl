import sqlite3

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

cur.execute('''UPDATE Strony SET wsp_nowy=1.0, wsp_stary=0.0''')
conn.commit()

cur.close()

print("Wszystkie strony mają ustawiony współczynnik PageRank na 1.0")
