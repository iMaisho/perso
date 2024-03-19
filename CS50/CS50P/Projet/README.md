# A League of Legends simulation
## Video Demo:  https://youtu.be/II1cxmEYi0o

### Description:
*League of legends* is a 5 versus 5 battle arena game, in which the goal is to destroy the enemy base.
One of the best ways to reach that goal is to kill your enemies. Quick decision-making is crutial to win more games,
so i designed my program to answer a simple question : 
#### Given the state of the game, can you kill your enemy ?

### Notes
- Some elements of my code are going to be written in French, my native language. Not knowing how to speak French should (hopefully) not impact your comprehension of the code

- The code showed in the video as been (very) slightly improved since i recorded it, which is why it might look a bit different in this file.

- I would gladly take any feedback about my project, i hope you enjoy discovering it as much as i enjoyed creating it

- If you want to work with me on improvements for this program, feel free to contact me at antonin.mingam@gmail.com

## What I did
I first started by creating a Champion class, with every stats that would be needed for my project. I even added more and could still expand quite a lot (*League of Legends* is a complex system)

```python
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
```

My main function create two instances of this Class, one Champion will be the damage dealer, and the other one will take the hits. Let's first see how the combat is implemented, we will dig down in the Champion instancing later.


```python
# main function
def main():
    championAtk = create_champion()
    championDef = create_champion()
    result = combat(championAtk, championDef)
    print(result)
```


```python
# combat function
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
```

So, as you can see the program takes in consideration 3 main stats :
- AD or attack damage
- HP or health points
- Armor

The values that are passed into the function is the AD of the attacked, and the armor and health of the defender.

The program then calculates a hit value using league's official math, and substracts this value from the current health points of the defender. It then prints out  some informations about how the fight is going, until the defender's health points are below 0. It then returns the outcome of the fight, and how many hits it took to kill the defender.

### Adding items into the mix

In *league of legends*, all your champion's stats can be improved by buying items in the shop.
There are over 100 items, some with just raw stats, some with passive or active abilities. This really was way too much to handle for me at this point, so I decided to implement 3 basic items, as a proof of concept.

- Long Sword, 10 AD
- Ruby Cristal, 150 HP
- Cloth Armor, 10 armor

I first started by asking the user how many items the Champion i am currently creating was holding. This simple function returns this number n.

```python
def number_item():
    while True:
        try:
            n = int(input("Nombre d'objets du champion: "))
            if 0 <= n <= 6:
                return n
            else:
                print("6 objets maximum")
        except ValueError:
            print("Valeur incorrecte")
```

I then ask the user what item the champion is holding, checking in a list of dicts if this item exists. If it does, I append this item to a new list, and repeat until the list has n elements in it, then return the list.

```python
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
```
Then I implemented a function that takes this list as input, and returns a tuple of values in the format (HP, AD, armor)

```python
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
```
### Instance of Champion :

This function calls all the functions above, as well as another one called get_level() which i will present below. This allows me to get all the informations I need to create an instance of the Champion with the correct stats. You should be able to understand it pretty easily with that in mind.

```python
# Instanciating a Champion
def create_champion():
    with open("project_champions.json") as file:
        champions = json.load(file)
    while True:
        champion_name = input("Entrez le nom de votre champion: ").title()
        for champion in champions:
            if champion["name"] == champion_name:
                lvl = champion_level()
                items_number = number_item()
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
```
Please note that this function as well as the *Champion( )* class contain some mentions of "MR", or magic resistance. This feature is not used in the program, but could be in some future versions of the program.

```python
# A simple functions that returns the champion's level
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
```

### Wait, where does the data come from ?
For this project, I really wanted to use some of the I/O features that we learned about in CS50P, as most if not all real-life projects require handling real data from the real world.

In my *create_champion( )* function, you might have noticed this :
```python
def create_champion():
    with open("project_champions.json") as file:
        champions = json.load(file)
```
When I first started the project, I created a simple list of two champions, and took my data from it, just to check if my other functions were working. It looked like this : 
```python
[
    {"name": "Rengar", "hp": 650, "hp+": 104, "ad": 68, "ad+": 3, "armor": 34, "armor+": 4.2, "mr": 32, "mr+": 2.05},
    {"name": "Yuumi", "hp": 500, "hp+": 69, "ad": 49, "ad+": 3.1, "armor": 25, "armor+": 4.2, "mr": 25, "mr+": 1.1}
]
```

I knew I would have to get real data. With close to 170 champions in the game, i really did not want to write each line with my poor keyboard. So I took the developper's approach and decided to create a program that would handle that for me.

I found the official, up-to-date data I needed at this link :  https://ddragon.leagueoflegends.com/cdn/14.2.1/data/en_US/champion.json

Here's how I created a list of dictionnaries that looked just like the list above.

```python 
import requests
import json

response = requests.get(
    "https://ddragon.leagueoflegends.com/cdn/14.2.1/data/en_US/champion.json"
)
data = response.json()

champion_data = data["data"]
champion_list = []

for champion_name, champion_info in champion_data.items():
    stats = champion_info.get("stats")
    champion_dict = {
        "name": champion_name,
        "hp": stats.get("hp"),
        "hp+": stats.get("hpperlevel"),
        "ad": stats.get("attackdamage"),
        "ad+": stats.get("attackdamageperlevel"),
        "armor": stats.get("armor"),
        "armor+": stats.get("armorperlevel"),
        "mr": stats.get("spellblock"),
        "mr+": stats.get("spellblockperlevel"),
    }
    champion_list.append(champion_dict)

with open("project_champions.json", "w") as file:
    json.dump(champion_list, file, indent=1)

```

And voilà ! I now had a list containing all the champions in the game, that my program could read and understand. I could play as any champion in the game.

### Improvements, future-proofing and crazy ideas

*League of Legends* is a complex system, with a lot of features. Replicating all of those in my program revealed to be way more challenging than I anticipated.

MR is a relic of my original idea, which was way out of my reach for now (I did not mean to rebuild league of legends from scratch by my own in a few days...)

Here are a few steps that could be taken to improve this program. This list is not exhaustive, and some ideas are way too hard for me to implement for now.

#### -- Improve the items system

Over 100 items in the game, sometimes with passive or active abilities.

#### -- Add champions passive and active spells

Each champion has one passive and 4 active spells (some even more). Obviously the game is way more complex and way more interesting with these, and so would my program be.

#### -- Add Magic Damage

Some champions deal Magic Damage with their spells. Instead of being reduced with armor, these sources of damage are reduced with Magic Resistance.

#### -- Add other stats

Armor or magic pen, Shreding, Cooldowns, Attack Speed...

#### -- In Game Use
To be useful in game, the program should be able the get the data about every player in the game to simulate each 1v1. 
This could be achieved with some APIs maybe, or even image recognition that could analyse each player's champion and items.

