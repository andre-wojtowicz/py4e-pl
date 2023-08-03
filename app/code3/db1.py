import sqlite3

conn = sqlite3.connect('muzyka.sqlite')
cur = conn.cursor()

cur.execute('DROP TABLE IF EXISTS Utwory')
cur.execute('CREATE TABLE Utwory (tytuł TEXT, odtworzenia INTEGER)')

conn.close()

