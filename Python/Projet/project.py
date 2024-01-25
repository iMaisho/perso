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
    champion_name = input("Entrez le nom de votre champion: ").title()
    with open("project_champions.json") as file:
        champions = json.load(file)
    for champion in champions:
        if champion["name"] == champion_name:
            lvl = champion_level()
            items = equip_item()
            if items != []:
                item_hp, item_ad, item_armor = get_stats(items)
            else:
                item_hp, item_ad, item_armor = 0, 0, 0
            return Champion(
                name=champion["name"],
                level=lvl,
                hp=champion["hp"] + (champion["hp+"] * lvl) + item_hp,
                ad=champion["ad"] + (champion["ad+"] * lvl) + item_ad,
                armor=champion["armor"] + (champion["armor+"] * lvl) + item_armor,
                mr=champion["mr"] + (champion["mr+"] * lvl),
            )
    else:
        sys.exit("Ce champion n'existe pas.")


def champion_level():
    try:
        lvl = int(input("Niveau du champion: "))
        if 0 < lvl <= 18:
            return lvl
        else:
            sys.exit("Niveau incorrect")
    except ValueError:
        sys.exit("Valeur incorrecte")


def equip_item():
    items = [
        {"name": "long sword", "ad": 10},
        {"name": "ruby cristal", "hp": 150},
        {"name": "cloth armor", "armor": 10},
    ]
    equiped = []
    try:
        n = int(input("Nombre d'objets du champion: "))
        if 0 <= n <= 6:
            for _ in range(n):
                item_name = input("Nom de l'objet: ").lower()
                for item in items:
                    if item_name == item["name"]:
                        equiped.append(item)
                        break
                else:
                    sys.exit("Cet objet n'existe pas.")
            return equiped
        else:
            raise ValueError
    except ValueError:
        sys.exit("Valeur incorrecte")


def get_stats(items):
    hp = 0
    ad = 0
    armor = 0
    for item in items:
        if "hp" in item:
            hp += item["hp"]
        if "ad" in item:
            ad += item["ad"]
        if "armor" in item:
            armor += item["armor"]
    return hp, ad, armor


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
