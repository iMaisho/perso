import sys
import time
import json


class Champion:
    def __init__(self, name, level, hp, ad, armor, mr):
        self.name = name
        self.level = level
        self.hp = hp
        self.ad = ad
        self.armor = armor
        self.mr = mr

    def __str__(self):
        return f"{self.name}: Niveau {self.level}, {self.hp} HP, {self.ad} AD, {self.armor} d'armure, {self.mr} de résistances magique"


def main():
    championAtk = create_champion()
    championDef = create_champion()
    result = combat(championAtk, championDef)
    print(result)


def create_champion():
    champion_name = input("Entrez le nom de votre champion: ")
    with open("project_champions.json") as file:
        champions = json.load(file)
    for champion in champions:
        if champion["name"] == champion_name.title():
            lvl = championlevel()
            return Champion(
                name=champion["name"],
                level=lvl,
                hp=champion["hp"] + (champion["hp+"] * lvl),
                ad=champion["ad"] + (champion["ad+"] * lvl),
                armor=champion["armor"] + (champion["armor+"] * lvl),
                mr=champion["mr"] + (champion["mr+"] * lvl),
            )
    else:
        sys.exit("Ce champion n'existe pas.")


def championlevel():
    try:
        lvl = int(input("Niveau du champion: "))
        if 0 < lvl <= 18:
            return lvl
        else:
            sys.exit("Niveau incorrect")
    except ValueError:
        sys.exit("Valeur incorrecte")


def combat(a, d):
    ad = a.ad
    hp = d.hp
    armor = d.armor
    i = 0
    while True:
        if hp > 0:
            hit = ad * (100 / (100 + armor))
            hp = hp - hit
            i += 1
            print(f"{a.name} a infligé {hit:.2f} points de dégats à {d.name}.")
            print(f"PV restants : {hp:.2f}")
            time.sleep(0.3)
        else:
            return f"{a.name} a tué {d.name} en {i} coups !"


if __name__ == "__main__":
    main()
