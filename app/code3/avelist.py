numlist = list()
while True:
    inp = input('Wprowadź liczbę: ')
    if inp == 'gotowe': break
    value = float(inp)
    numlist.append(value)

average = sum(numlist) / len(numlist)
print('Średnia:', average)
