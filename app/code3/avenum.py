total = 0
count = 0
while True:
    inp = input('Wprowadź liczbę: ')
    if inp == 'gotowe': break
    value = float(inp)
    total = total + value
    count = count + 1

average = total / count
print('Średnia:', average)
