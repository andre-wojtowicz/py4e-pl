import sqlite3

conn = sqlite3.connect('friends.sqlite')
cur = conn.cursor()
cur.execute('SELECT * FROM Osoby')
count = 0
print("Osoby:")
for row in cur:
    print(row)
    count = count + 1
print(count, 'wierszy.')
cur.execute('SELECT * FROM Obserwuje')
count = 0
print("\nObserwuje:")
for row in cur:
    print(row)
    count = count + 1
print(count, 'wierszy.')
cur.close()
