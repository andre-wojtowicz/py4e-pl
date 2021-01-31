counts = dict()
print('Wpisz linię tekstu:')
line = input('')

words = line.split()

print('Słowa:', words)

print('Zliczam...')
for word in words:
    counts[word] = counts.get(word, 0) + 1
print('Liczba:', counts)
