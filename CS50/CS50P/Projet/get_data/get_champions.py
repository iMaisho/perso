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
