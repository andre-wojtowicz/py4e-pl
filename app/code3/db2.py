import sqlite3

conn = sqlite3.connect('muzyka.sqlite')
cur = conn.cursor()

cur.execute('INSERT INTO Utwory (tytuł, odtworzenia) VALUES (?, ?)', 
    ('Thunderstruck', 20))
cur.execute('INSERT INTO Utwory (tytuł, odtworzenia) VALUES (?, ?)', 
    ('My Way', 15))
conn.commit()

print('Utwory:')
cur.execute('SELECT tytuł, odtworzenia FROM Utwory')
for row in cur:
     print(row)

cur.execute('DELETE FROM Utwory WHERE odtworzenia < 100')
conn.commit()

cur.close()
