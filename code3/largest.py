largest = None
print('Przed:', largest)
for itervar in [9, 41, 12, 3, 74, 15]:
    if largest is None or itervar > largest :
        largest = itervar
    print('Pętla:', itervar, largest)
    
print('Po:', largest)
