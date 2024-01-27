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
    with open("project_champions.json") as file:
        champions = json.load(file)
    while True:
        champion_name = input("Entrez le nom de votre champion: ").title()
        for champion in champions:
            if champion["name"] == champion_name:
                lvl = champion_level()
                items_number = number_items()
                items = equip_items(items_number)
                items_hp, items_ad, items_armor = get_stats(items)
                return Champion(
                    name=champion["name"],
                    level=lvl,
                    hp=champion["hp"] + (champion["hp+"] * lvl) + items_hp,
                    ad=champion["ad"] + (champion["ad+"] * lvl) + items_ad,
                    armor=champion["armor"] + (champion["armor+"] * lvl) + items_armor,
                    mr=champion["mr"] + (champion["mr+"] * lvl),
                )
        else:
            print("Ce champion n'existe pas.")


def champion_level():
    while True:
        try:
            lvl = int(input("Niveau du champion: "))
            if 0 < lvl <= 18:
                return lvl
            else:
                print("Niveau incorrect")
        except ValueError:
            print("Valeur incorrecte")


def number_items():
    while True:
        try:
            n = int(input("Nombre d'objets du champion: "))
            if 0 <= n <= 6:
                return n
            else:
                print("6 objets maximum")
        except ValueError:
            print("Valeur incorrecte")


def equip_items(n):
    items = [
        {"name": "long sword", "ad": 10},
        {"name": "ruby cristal", "hp": 150},
        {"name": "cloth armor", "armor": 10},
    ]
    equipped = []

    for _ in range(n):
        item_found = False
        while not item_found:
            item_name = input("Nom de l'objet: ").lower()
            for item in items:
                if item_name == item["name"]:
                    equipped.append(item)
                    item_found = True
                    break
            else:
                print(
                    "Cet objet n'existe pas. | long sword : 10 AD, ruby crital : 150 hp, cloth armor : 10 armor"
                )
    return equipped


def get_stats(items):
    hp = 0
    ad = 0
    armor = 0
    if items != []:
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
