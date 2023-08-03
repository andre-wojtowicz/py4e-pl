class PartyAnimal:
    x = 0
    name = ''
    def __init__(self, nam):
        self.name = nam
        print(self.name, '- utworzenie')

    def party(self) :
        self.x = self.x + 1
        print(self.name, '- zliczenie imprezek -', self.x)

s = PartyAnimal('Sally')
j = PartyAnimal('Jim')

s.party()
j.party()
s.party()
