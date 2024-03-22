# SQL

Dans le monde de la programmation, il existe différents outils pour différents problèmes. Chaque langage est optimisé avec une philosophie en tête, ce qui leur permet de résoudre certains types de problèmes de manière plus simple et plus efficace.


Les logiciels adaptés au traitement de données seraient les tableurs ou spreadsheets. Cependant, dans le cas où on récupère des données via notre propre site ou application, le plus simple est de les stocker dans un fichier texte.

## Flat-file database

Ce genre de base de données est légère et facile à manipuler en code. Le plus commun est d'utiliser un CSV (comma separated values).
La virgule permet de créer les colonnes, et le passage à la ligne permet de créer les lignes.

Comment manipuler un fichier CSV en python ?

Imaginons un fichier qui contient les colonnes "Timestamp", "Language" and "Problem"

```python
import csv

# with nous permet de manipuler le fichier sans avoir à penser à utiliser close() plus tard
# "r" pour read est la valeur par défaut et pourrait être ommise
with open("filename.csv", "r") as file:
    # le reader parcours le fichier pour nous
    reader = csv.reader(file)
    # next() permet de skip le header du fichier CSV
    next(reader)
    for row in reader:
        # imprime chaque valeur de la colonne "language"
        print(row[1])
```

Le problème avec ce code est que l'on fait confiance au fait que la colonne 1 contient toujours la valeur du langage préféré. Cependant, des erreurs de programmation ou des erreurs humaines pourraient avoir modifié l'ordre ou les valeurs du CSV.

Pour régler ce problème, on utilise DictReader, crée un dictionnaire pour chaque ligne qui contient le nom de la colonne en guise de key, et le contenu de la cellule en guise de valeur.

```python
import csv

with open("filename.csv", "r") as file:
    reader = csv.DictReader(file)
    for row in reader:
        print(row["language"])
```

Et si nous voulons compter combien d'élève préfèrent tel ou tel langage ?

```python
import csv

with open("filename.csv", "r") as file:
    reader = csv.DictReader(file)
    scratch, c, python = 0, 0, 0
    for row in reader:
        favorite = row["language"]
        if favorite == "Scratch":
            scratch += 1
        elif favorite == "C":
            c += 1
        elif favorite == "Python":
            python += 1

print(f"Scratch : {scratch}")
print(f"C: {c}")
print(f"Python: {python}")
```

Une façon plus "pythonique" de résoudre ce problème serait d'utiliser un dictionnaire au lieu d'utiliser 3 variables.

```python
import csv

with open("filename.csv", "r") as file:
    reader = csv.DictReader(file)
    counts = {}

    for row in reader:
        favorite = row["language"]
        if favorite in counts:
            counts[favorite] += 1
        else:
            counts[favorite] = 1

for favorite in counts:
    print(f"{favorite}: {counts[favorite]})
```

On peut utiliser sorted pour print les résultats dans l'ordre alphabetique, mais le plus logique serait sûrement de les trier par ordre de popularité, en utilisant l'argument key de la fonction sorted.

```python
for favorite in sorted(counts, key=counts.get, reverse=True):
    print(f"{favorite}: {counts[favorite]})
```

Cette syntaxe avec 3 arguments permet à sorted de se fier aux valeurs au lieu des keys, et reverse permet d'afficher le plus gros résultat en premier, le comportement par défaut étant de trier dans l'ordre croissant.

Il existe également des outils appelés Counter, qui permettent de compter le nombre de répétition d'une valeur grâce à la syntaxe suivante :

```python
import csv

with open("filename.csv", "r") as file:
    reader = csv.DictReader(file)
    counts = Counter()
    for row in reader:
        favorite = row["language"]
        counts[favorite] += 1
    
    for favorite, count in counts.most_common():
    print(f"{favorite}: {count}")
```

La fonction most_common() retourne une paire de key/value à chaque itération, et nous permet donc de récupérer favorite et count en une seule ligne de code.

Et si nous cherchions à rendre ce programme plus interactif ?

```python
import csv

with open("filename.csv", "r") as file:
    reader = csv.DictReader(file)
    counts = Counter()
    for row in reader:
        favorite = row["language"]
        counts[favorite] += 1
    
favorite = input("Favorite: ")
print(f"{favorite}: {counts[favorite]}")
```

Ce code permet à l'utilisateur de taper son exercice préféré, et de voir combien de gens dans la base de données ont voté pour cet exercice.

## Relational database

En programmation, on cherche à écrire le moins de code possible, en utilisant les bons outils.

Au lieu d'utiliser des CSV, il existe un monde des programmes de bases de données, qui supporte un langage qui rend beaucoup plus simple d'intéragir avec des bases de données. On appelle cela Relational database car on peut avoir plusieurs bases de données avec des liens entre eux.

SQL = Structured Query Language.

C'est un langage de programation simple, avec peu de syntaxe qui permet d'agir sur des données de 4 manière (CRUD) :

- Create (ou Insert)
- Read (Select)
- Update
- Delete (ou Drop)

```SQL
CREATE TABLE table (column type, ...);
```

C'est avec cette syntaxe que l'on crée un tableur.

Dans le cadre de CS50, on utilisera une version plus légère de SQL, appelée sqlite3 qui est également utilisé dans le monde réel, par exemple pour les jeux mobiles.

Pour utiliser sqlite3, on va essentiellement utiliser le terminal. On ne créera pas de fichier texte mais directement un fichier binaire.


Voilà comment **créer la base de données**, et importer notre fichier CSV dans celle-ci :
```console
$ sqlite3 favorites.db
Are you sure you want to create favorites.db? [y/N] y
sqlite> .mode csv
sqlite> .import favorites.csv favorites
sqlite> .quit
$
```
On peut avoir des informations sur notre fichier grâce à cette commande :

```console
$ sqlite3 favorites.db
sqlite> .schema
CREATE TABLE IF NOT EXISTS "favorites"("Timestamp" TEXT, "language" TEXT, "problem" TEXT);
```
### Afficher les données
On peut utiliser ce genre de syntaxe pour afficher **toutes les données** de notre base dans notre terminale, sous la forme d'un tableau en ASCII

```console
sqlite> SELECT * FROM favorites;
```

Si on veut être un  peu plus spécifique sur les données à afficher, on peut utiliser cette syntaxe pour **afficher une seule colonne** :

```console
sqlite> SELECT language FROM favorites;
```

On peut **limiter le nombre de lignes** à afficher en utilisant cette syntaxe : 
```console
sqlite> SELECT language FROM favorites LIMIT 10;
```

### Manipuler les données 

SQL vient avec tout un tas de fonctions que l'on peut utiliser, dans la même veine que LIMIT.
- AVG = Average
- COUNT 
- DISTINCT = Unique
- LOWER
- MAX
- MIN
- UPPER
- ...

Pour compter **combien de lignes** contient notre database, on peut utiliser COUNT de cette manière :

```console
sqlite> SELECT COUNT(*) FROM favorites;
```

Pour savoir quels sont les **contenus uniques de ces lignes**, par exemple des langages de programmation :

```console
sqlite> SELECT DISTINCT(language) FROM favorites;
```

Pour savoir **combien de langages distincts** il y a dans ces réponses, on peut nester ces fonctions :

```console
sqlite> SELECT COUNT(DISTINCT(language)) FROM favorites LIMIT 10;
```

Quelques mots clefs supplémentaires :

- WHERE
- LIKE
- ORDER BY
- LIMIT
- GROUP BY

Si on veut filtrer par rapport à une réponse :

```console
sqlite> SELECT COUNT(*) FROM favorites WHERE language = 'C';
```

Par rapport à deux réponses :

```console
sqlite> SELECT COUNT(*) FROM favorites WHERE language = 'C' AND problem = 'Hello, World';
```

Note : On utilise AND et pas "&&", on utilise "=" et pas "==".

Maintenant que l'on connait les bases du langage, voici quelques applications plus utiles.
Si on souhaite **grouper par type de langage et compter le nombre de réponse pour chacun de ces langages**, on peut utiliser les fonctions suivantes, en une seule ligne de code :

```console
sqlite> SELECT language, COUNT(*) FROM favorites GROUP BY language;
```

Cela nous donnera un tableau contenant les 3 langages, et le nombre de réponses associé à chacun de ces langages.

Si on veut les ordonner, on peut ajouter ORDER BY puis la valeur par laquelle on veut trier. On peut aussi ajouter ASC (ascending) ou DESC (descending) pour choisir dans quel sens les ordonner.

On peut également renommer les catégories, par exemple COUNT(*) en utilisant le mot clef AS

```console
sqlite> SELECT COUNT(*) as n FROM favorites GROUP BY language ORDER BY n DESC;
```

### Ajouter des données

```console
sqlite> INSERT INTO table (column1, column2, ...) VALUES(value1, value2,...);
```

Par exemple si on souhaitait ajouter une réponse à notre tableau, on pourrait écrire : 

```console
sqlite> INSERT INTO favorites (language, problem) VALUES('SQL', 'Training');
```

Note : On a pas ajouté de Timestamp, donc sa valeur est NULL

### Supprimer des données

**ATTENTION**

```console
sqlite> DELETE FROM favorites;
```
Cette commande **SUPPRIMERA TOUTE LA BASE DE DONNEES**.
Ne pas utiliser à moins d'être certain que c'est ce que l'on veut faire. Sinon, il faut rajouter des conditions de suppression.

```console
sqlite> DELETE FROM favorites WHERE Timestamp IS NULL;
```

### Modifier des données 

```console
sqlite> UPDATE favorites SET language = 'SQL', problem = 'Training';
``` 

Cette ligne de commande modifiera les valeurs de toutes les données du tableau.

Ces commandes sont **destructives**. A moins d'avoir un backup de la base de données, on ne pourra pas retrouver les données originales.

## Construire une base de données efficace.

Supposons qu'on veut créer une base de donnée du type d'IMDb, en liant des shows avec les acteurs qui le compose dans un Excel.

Si on crée une ligne par show, on va avoir un nombre inderminé de colonnes pour les acteurs.

Si on crée une colonne pour tous les acteurs, on va devoir répéter le nom du show à chaque fois.

Ces deux designs ne sont pas optimaux.

Pour palier ce problème, on va ajouter une catégorie : les ID uniques.

On crée un tableur qui contient les shows et leur ID, un tableur qui contient les stars et leur ID, et un 3ème tableur qui contient une colonne avec l'ID des shows, et une colonne avec l'ID des acteurs.

On pourrait penser qu'on a la même problématique, avec l'ID du show qui se répète, mais la nuance est qu'il s'agit d'une int, qui prends moins de place dans la mémoire, qui évite les fautes de typo etc...

De plus cela permet d'avoir encore plus de données liées les unes aux autres.


