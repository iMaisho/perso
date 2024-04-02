# SQL

Dans le monde de la programmation, il existe différents outils pour différents problèmes. Chaque langage est optimisé avec une philosophie en tête, ce qui leur permet de résoudre certains types de problèmes de manière plus simple et plus efficace.

Les logiciels adaptés au traitement de données seraient les tableurs ou spreadsheets. Cependant, dans le cas où on récupère des données via notre propre site ou application, le plus simple est de les stocker dans un fichier texte.

## Flat-file database

Ce genre de base de données est légère et facile à manipuler en code. Le plus commun est d'utiliser un CSV (comma separated values).
La virgule permet de créer les colonnes, et le passage à la ligne permet de créer les lignes.

Comment manipuler un fichier CSV en python ?

Imaginons un fichier qui contient les colonnes `Timestamp`, `Language` and `Problem`

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
    print(f"{favorite}: {counts[favorite]}")
```

On peut utiliser sorted pour print les résultats dans l'ordre alphabetique, mais le plus logique serait sûrement de les trier par ordre de popularité, en utilisant l'argument key de la fonction sorted.

```python
for favorite in sorted(counts, key=counts.get, reverse=True):
    print(f"{favorite}: {counts[favorite]}")
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

Si on veut être un peu plus spécifique sur les données à afficher, on peut utiliser cette syntaxe pour **afficher une seule colonne** :

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

On peut également renommer les catégories, par exemple COUNT(\*) en utilisant le mot clef AS

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

![Alt](https://github.com/iMaisho/perso/blob/main/Ressources/Images/IMDb%20Structure.png?raw=true)
_la structure des bases de données d'IMDb_

### One to One

Si on analyse le lien entre **ratings** et **shows**, la flèche nous indique qu'on est dans une relation "un pour un", c'est à dire qu'un show aura un seul rating.

On pourrait théoriquement les mettre dans la même database sans poser de problème, mais IMDb a fait le choix de les garder séparés.

#### Datatypes

Dans sqlite, si on utilise la fonction .schema sur une base de données, on obtient les noms des colonnes, et le type de données qu'elles peuvent contenir.

- BLOB = Binary Large Object
- INTEGER
- NUMERIC = Dates, Time
- REAL = Float
- TEXT

Les autres programmes basés sur SQL (Oracle, MySQL, ...) utilisent des fonctions différentes et ont des noms différents pour ces types de données, mais fonctionnent sur la même idée générale.

Il y a d'autres mots clefs qui peuvent être ajoutés à ces datatypes :

- NOT NULL = Pour être sûr que ce champ est rempli avant de l'intégrer à la base de données
- UNIQUE

#### Primary Key and Foreign Key

Quand on donne un ID à une donnée dans un tableau, c'est une primary key car c'est là qu'elle est créée/attribuée.

Quand on référence cet ID dans un autre tableau, c'est une Foreign Key car on l'utilise pour faire le lien avec les primary keys des tableaux originaux.

On peut voir ces différences en utilisant .schema :

```console
sqlite> .schema shows$
CREATE TABLE shows (
    id INTERGER,
    title TEXT NOT NULL,
    year NUMERIC,
    episodes INTEGER,
    PRIMARY KEY(id)
);

sqlite> .schema ratings
CREATE TABLE ratings(
    show_id INTEGER NOT NULL,
    rating REAL NOT NULL,
    votes INTEGER NOT NULL,
    FOREIGN KEY(show_id) REFERENCES shows(id)
)
```

#### Nested Queries

Imaginons qu'on aimerait voir les shows qui ont un rating supérieur à 8.

```console
SELECT show_id FROM ratings WHERE rating >= 8.0;
```

Cette commande nous affichera tous les ID que l'on recherche. Seulement, ce n'est pas très utile car on obtient une liste de nombres cryptiques, et si on doit rechercher ces nombres un par un dans le tableau "show", on aura pas gagné beaucoup de temps.

On peut donc faire une recherche imbriquée, où la recherche entre parenthèse sera résolue en premier :

```console
SELECT title FROM shows WHERE id IN (SELECT show_id FROM ratings WHERE rating >= 8.0);
```

On va donc obtenir la liste des ID des shows avec une note de 8 ou plus, puis on va aller chercher les noms des shows dans shows qui correspondent à ces ID.

Cependant, on ne verra que les titres des shows, et pas leur note, ce qu'on pourrait vouloir voir pour séléctionner plus précisément ce qu'on aimerait voir. Pour cela on utilise un nouveau mot clé : **JOIN**

```console
sqlite> SELECT title, rating FROM shows JOIN ratings ON shows.id = ratings.show_id WHERE rating >= 8.0 LIMIT 10;
```

### One to Many

![Alt](https://github.com/iMaisho/perso/blob/main/Ressources/Images/IMDb%20Structure.png?raw=true)
_la structure des bases de données d'IMDb_

Si on analyse le lien entre shows et genres, on peut voir que la flèche est différente. Cela est dû au fait qu'un seul show peut avoir plusieurs genres.

Lorsque l'on veut JOIN deux tableaux dans une relation one to many, le résultat affiché dupliquera le nom du show sur chaque ligne du nouveau tableau.

Ce n'est pas grave, car les copies ne sont pas stockées dans la mémoire, simplement dans ce nouveau tableau éphémère qui est seulement là pour qu'on l'observe avec nos yeux.

### Many to many

Un acteur peut jouer dans plusieurs shows, et un show peut accueillir plusieurs acteurs.

On doit donc créer un 3ème tableau : stars qui permet de faire le lien entre le tableau people et le tableau shows.

Rechercher des données liées par les deux tableaux est un peu plus compliqué :

```console
sqlite> SELECT * FROM shows WHERE title = 'The Office' AND year = 2005;
```

Cette ligne nous permet de trouver la série que l'on cherche, ici The Office

```console
sqlite> SELECT person_id FROM stars WHERE show_id =
        (SELECT id FROM shows WHERE title = 'The Office' AND year = 2005);
```

Cette ligne nous permet de trouver les ID des acteurs de la série

```console
sqlite> SELECT name FROM people WHERE id IN
        (SELECT person_id FROM stars WHERE show_id =
        (SELECT id FROM shows WHERE title = 'The Office' AND year = 2005));
```

Cette ligne nous permet de trouver les noms liés à ces ID.

On peut également JOIN ces différents tableaux pour accéder à certaines informations. Imaginons que nous souhaitons trouver tous les shows dans lesquels Steve Carell a joué. Il y a plusieurs façon d'arriver à ce résultat :

```console
sqlite> SELECT title FROM shows WHERE id IN
        (SELECT show_id FROM stars WHERE person_id =
        (SELECT id FROM people WHERE name = 'Steve Carell'));
```

Ici, c'est la même logique qu'au dessus : On va chercher l'ID de Steve Carell, puis chercher dans stars à quels show_id ce person_id est associé, puis chercher dans shows quels titres sont associés à ces show_id. C'est la méthode la plus rapide

```console
sqlite> SELECT title FROM shows
        JOIN stars ON shows.id = stars.show_id
        JOIN people ON stars.person_id = people.id
        WHERE name = 'Steve Carell';
```

Ici, on lie les 3 tableaux en alignant "shows.id" avec "stars.show_id" et "stars.person_id" avec "people.id", puis on va chercher dans ce grand tableau les titres des shows pour lesquels le nom de l'acteur Steve Carell apparait.

```console
sqlite> SELECT title GROM shows, stars, people
        WHERE shows.id = stars.show_id
        AND people.id = stars.person_id
        AND name = 'Steve Carell'
```

Un peu similaire, mais au lieu de lier les 3 tableaux avec JOIN, on va directement chercher dans les 3 tableaux

Ces deux dernières méthodes sont beaucoup plus lente à utiliser, mais on a une méthode pour régler ce problème.

### Index

Lorsqu'on sait qu'une catégorie va souvent être recherchée par les utilisateurs, il peut être malin de créer un INDEX pour cette catégorie. Cela prends un peu de temps, mais on a besoin de ne le faire qu'une fois (sauf quand on met à jour sa base de données).

Au lieu d'utiliser le linear search, l'indexation va créer un B-Tree qui est un arbre dont chaque node a beaucoup d'enfants, et qui est donc très court.

Cette structure va permettre de réduire le temps de recherche, au prix de mémoire. Cela rendra également plus lentes les modifications de la base de données, car il faudra modifier les indexs en même temps pour éviter de casser les arbres. Il faut donc les utiliser intelligemment.

Par défaut, les Primary Keys sont indexées, mais ce n'est pas le cas pour les Foreign Keys et les autres datatypes.

La syntaxe est la suivante :

```console
sqlite> CREATE INDEX index_name ON table_name (collumn_name);
```

Par exemple, pour les titres des shows :

```console
sqlite> CREATE INDEX title_index ON shows (title);
```

## SQL dans python

cs50.readthedocs.io/libraries/cs50/python/#cs50.SQL

La vraie force des langages spécialisés, c'est qu'on peut y faire appel dans des programmes codés dans des langages différents.

Le syntaxe native pour utiliser SQL dans Python étant un peu compliquée, CS50 vient avec son propre module SQL.

En reprenant notre exemple de départ, la base de données où les élèves ont donné leur langage préféré ainsi que leur exercice préféré, voilà comment on pourrait récupérer le nombre d'élève ayant voté pour le langage que l'utilisateur input :

```python
from cs50 import SQL

# db = database, on pourrait lui donner un autre nom
# sqlite:///dabatase_name <- 3 slashes
db = SQL("sqlite:///favorites.db")

favorite = input("Favorite: ")

# ? fait office de placeholder pour la variable favorite
rows = db.execute("SELECT COUNT(*) AS n FROM favorites WHERE problem = ?", favorite)
row = rows[0]

print(row["n"])
```

## Race conditions

Imaginons que ma chérie et moi aimons beaucoup le lait. J'ouvre le frigo, me rends compte qu'il n'y a plus de lait, et décide d'aller en acheter. Ma chérie ouvre le frigo;, voit qu'il n'y a plus de lait et décide également d'aller en acheter.

Quand nous rentrons des courses, nous avons 2x trop de lait, parce qu'alors que la valeur du lait était en train d'être incrémentée quand je suis parti faire les courses, une autre personne a demandé à voir la valeur actuelle.

Cette analogie représente ce qui peut arriver lorsque beaucoup d'utilisateurs envoient beaucoup de requêtes à beaucoup de serveur, comme des likes sur Instagram.

Si beaucoup d'utilisateurs envoient des likes en même temps, il se pourrait que la valeur des likes actuels ne soient pas encore à jour quand on l'incrémente, donc on perd des likes au passage.

Ex :

- 0 likes actuellement,
- Je like, elle like.
- Je récupère la valeur 0
- Elle récupère la valeur 0
- J'incrémente, elle incrémente
- Je renvoie la valeur 1 au serveur
- Elle renvoie la valeur 1 au serveur
- Résultat : 1 like sur le post au lieu de 2

Il y a des solutions à ces problèmes :

- BEGIN TRANSACTION / COMMIT: Fait en sorte que toutes les lignes de code s'exécutent ensemble, ou ne s'exécutent pas

- ROLLBACK

## SQL Injection Attack

Il est important d'utiliser la syntaxe avec les placeholders "?" afin de s'assurer de ne pas risquer une attaque par injection.

Par exemple, sur un formulaire de connexion, on pourrait avoir une faille qui permettrait de faire de la partie du code qui demande le password un commentaire, bypassant totalement la sécurité du site, et permettant de se connecter seulement avec l'identifiant de connexion.
