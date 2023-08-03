inp = input('Podaj temperaturę w skali Fahrenheita: ')
try:
    fahr = float(inp)
    cel = (fahr - 32.0) * 5.0 / 9.0
    print(cel)
except:
    print('Musisz wprowadzić liczbę')
