rawstr = input('Podaj liczbę: ')
try: 
    ival = int(rawstr)
except: 
    ival = -1

if ival > 0 :  
    print('Niezła robota')
else:  
    print('To nie jest liczba')
