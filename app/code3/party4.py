class PartyAnimal:
    x = 0

    def __init__(self):
        print('Jestem tworzony')

    def party(self) :
        self.x = self.x + 1
        print('Jak na razie', self.x)

    def __del__(self):
        print('Jestem niszczony', self.x)

an = PartyAnimal()
an.party()
an.party()
an = 42
print('an zawiera', an)
