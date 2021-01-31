class PartyAnimal:
    x = 0

    def party(self) :
        self.x = self.x + 1
        print("Jak na razie", self.x)

an = PartyAnimal()
an.party()
an.party()
an.party()
PartyAnimal.party(an)
