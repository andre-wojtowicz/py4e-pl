class PartyAnimal:
    x = 0

    def party(self) :
        self.x = self.x + 1
        print("Jak na razie", self.x)

an = PartyAnimal()
print("Type", type(an))
print("Dir ", dir(an))
print("Type", type(an.x))
print("Type", type(an.party))
