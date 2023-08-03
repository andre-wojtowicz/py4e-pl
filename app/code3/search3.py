fhand = open('mbox-short.txt')
for line in fhand:
    line = line.rstrip()
    # Pomiń 'nieciekawe' linie
    if not line.startswith('From:'):
        continue
    # Przetwarzaj 'interesujące' linie
    print(line)
