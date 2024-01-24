# Et Cetera...

## Les Sets
Un set est un espace qui permet de stocker des données à la manière d'une liste
Il ne converve pas les doublons
On peut lui faire les mêmes opérations que pour les listes, comme les trier avec sort()

```python
set = set()
```

## Variables globales
Une variable initialisée en haut d'un fichier est lisible par toutes les fonctions, mais ne peut pas être modifiée
Une variable initialisée dans une fonction peut être modifiée dans cette fonction, mais pas dans d'autres fonctions du programme
On peut contourner ce problème en initialisant la variable dans le fichier, et en ajoutant le mot clef "global" dans chaque fonction

```python
variable = 0

#OK
def main():
    print(variable)

#Ne fonctionne pas
def ajouter():
    variable =+1

#OK
def ajouter():
    global variable
    variable =+1

```

Cependant on préfèrera utiliser une classe, car l'argument self permet d'utiliser la variable dans toutes les méthodes (fonctions) de la classe.
C'est plus élégant et moins le bazar

```python
class Class:
    def __init__(self):
        self._variable = 0
    
    # Getter
    @property
    def variable(self):
        return self._variable
    
    def ajouter(self, n):
        self._variable =+ n
    
    def retirer(self, n):
        self._variable =- n
```

On pourra ensuite utiliser les fonctions ajouter() et retirer() librement sur la variable d'une instance de la classe, mais il nous sera impossible de modifier directement la valeur de la variable (i.e classe.variable = 1000), du fait de l'absence de setter.
## Constantes

Le "système d'honneur" de Python fait qu'il n'y a pas de constante réelle assignée au langage.
On nomme nos VARIABLES en MAJUSCULES pour indiquer aux lecteurs du code que cette variable doit rester constante.

## Type Hints

https://docs.python.org/3/library/typing.html

En python, lorsqu'on assigne une valeur à une variable, on est pas obligé de donner le type de valeur au programme.
Ca peut être primordial pour d'autres langages.



Le module mypy permet de vérifier que le programme fonctionne correctement, en vérifiant que les variables envoyées aux fonctions sont du bon type.

https://mypy.readthedocs.io/en/stable/

```python
# Un exemple de Type hint, int indique le type de n, et None la return value de meow
def meow(n: int) -> None:
    ...
# OU
number: int = int(input("Number: "))
```

## """Documentation (Docstring)"""

Certains outils permettent d'analyser, d'extraire ces informations et de générer du HTML ou des PDF, en mettant les commentaires entre des """triples-quotes"""

```python
def meow(n: int):
    """
    Meow n times.

    :param n: Number of times to meow
    :type n: int
    :raise TypeError: If n is not an int
    :return: A string of n meows
    :rtype: str
    """
    return "meow" *n
```

Ce n'est pas spécifique à Python, mais plutôt une convention.
Cela permet d'expliquer comment fonctionne son code.

## argparse

Argparse est une librarie qui permet de détecter des "command-line arguments" dans la ligne de commande.

Par exemple et par convention un nombre n sera passé au programme comme argument grâce à **"-n n"** ou **--number n**.

On peut se passer de sys et de sys.argv[] grâce à cela

```python
import argparse

parser = argparse.ArgumentParser()
#default donne une valeur par défaut à n si l'utilisateur ne tape pas -n n
#type convertit automatiquement n en int
parser.add_argument("-n", default = "1", type = int)
args = parser.parse_args()
```

Ce morceau de code permet d'itérer n fois
```python
for _ in range(args.n):
```
 grâce à une commande de terminal de type 
```shell
python programme.py -n 3
```

Si l'utilisateur ne parvient pas à utiliser le programme, il peut ajouter -h dans les arguments afin d'obtenir de l'aide. On peut donc ajouter des indices quand à la manière d'utiliser le programme.

On peut ajouter tout un tas d'arguments du type, avec d'autres lettres.

```python
import argparse

parser = argparse.ArgumentParser(description = "Description du programme")
parser.add_argument("-n", help = "ce à quoi correspond l'attribut -n")
args = parser.parse_args()
```

## Unpacking

Imaginons qu'une fonction doit prendre un nombre X d'arguments en input, par exemple

```python
def total(galleons, sickles, knuts):
    return (galleons * 17 + sickles) * 29 + knuts
```

Si on avait une liste qui contient les valeurs que l'on veut passer, et que l'on passait cette liste comme argument de la fonction, on passerait la liste comme premier argument de la fonction, et pas chacune des valeurs qu'elle contient.
On peut donc l'unpack pour extraire chacune des valeurs grâce à la syntaxe suivante :

```python
def total(galleons, sickles, knuts):
    return (galleons * 17 + sickles) * 29 + knuts

valeurs = [x, y, z]
total(*valeurs)
```
```python
*valeurs == "x, y, z"
```


Cette méthode ne fonctionne pas avec un set, car l'ordre des valeurs n'est pas conservé.
La taille de la liste doit être égale au nombre d'arguments nécéssaires à la fonction.

On peut par contre effectuer une opération similaire avec un dictionnaire, tant que les clefs correspondent aux noms des arguments de la fonction. On utilise cette fois un double astérisque pour extraire les valeurs du dictionnaire.

```python
def total(galleons, sickles, knuts):
    return (galleons * 17 + sickles) * 29 + knuts

valeurs = {"galleons": x, "sickles": y, "knuts": z}
total(**valeurs)
```

```python
**valeurs == "galleons=x, sickles=y, knuts=z"
```

Si le nombre de paires et que le nom des clefs du dictionnaire ne sont pas exactement les mêmes que le nombre et les noms des arguments de la fonction, cela ne fonctionnera pas.

## *args, **kwargs

Dans le cas ou on souhaiterait accepter un nombre indéterminé d'arguments dans notre fonction, on peut le faire grâce à ces syntaxes.

args = arguments
kwargs = key-word arguments

```python
def f(*args, **kwargs):
    print("Positional:" args)
    print("Named:" kwargs)
```

```python
#Si l'on veut travailler avec des arguments, ici 3 mais on pourrait choisir d'en passer plus ou moins
f(x, y, z)
#*args retourne une liste des arguments
Positional : (x, y, z)
```

```python
#Si l'on veut travailler avec des arguments nommés, ici 3 mais on pourrait en passer plus ou moins
f(galleons=x, sickles=y, knuts=z)
#**kwargs retourne un dictionnaire des arguments
Named : {"galleons": x, sickles": y, "knuts": z}
```

On utilise args et kwargs par convention, mais nous pouvons leur donner d'autres noms.
Par exemple, la fonction print() est documentée comme suit :
```python
def print(*objects, sep=" ", end=\n, ...)
```
Ce qui nous permet de lui passer un nombre indéterminé d'arguments, strings et autres.

## map

docs.python.org/3/library/functions.html#map

Imaginous que nous créons une fonction qui peut recevoir un nombre indéfini d'arguments, en utilisant *args comme vu précédemment.
Si nous souhaitions appliquer une opération à tous les éléments d'une liste, il nous faudrait itérer en créant une boucle 

```python
def main():
    yell("This", "is", "CS50")


def yell(*words):
    uppercased = []
    for word in words:
        uppercased.append(word.upper())
    print(*uppercased)


if __name__ == "__main__":
    main()
```

map nous permet d'utiliser une fonction X sur tous les arguments d'une fonction Y, sans avoir à utiliser cette syntaxe, et de créer une liste contenant ces éléments.

```python
def main():
    yell("This", "is", "CS50")


def yell(*words):
    #map(fonction, objet à modifier, ...)
    uppercased = map(str.upper, words)
    print(*uppercased)


if __name__ == "__main__":
    main()
```

## list comprehensions

Pour pouvoir créer une liste à partir d'un nombre variable d'arguments ou d'une autre liste, on peut également le signifier à python en utilisant cette syntaxe.

Cela permet de condenser la boucle sur une seule ligne de code.

```python
def main():
    yell("This", "is", "CS50")


def yell(*words):
    uppercased = [word.upper() for word in words]
    print(*uppercased)


if __name__ == "__main__":
    main()
```

On peut également utiliser ces lists comprehensions pour filtrer certains éléments d'une liste ou d'un dictionnaire dans une nouvelle liste grâce à une condition *if*

```python
students = [
    {"name": "Hermione", "house": "Gryffindor"},
    {"name": "Harry", "house": "Gryffindor"},
    {"name": "Ron", "house": "Gryffindor"},
    {"name": "Draco", "house": "Slytherin"},
]

gryffindors = [
    student["name"] for student in students if student["house"] == "Gryffindor"
]

for gryffindor in sorted(gryffindors):
    print(gryffindor)
```

# filter

https://docs.python.org/3/library/functions.html#filter

 De la même façon que map, filter attends deux arguments pour fonctionner. La différence étant que filter attend en premier argument, une fonction qui retourne une valeur booléenne, indiquant à filter si il faut inclure cet élément dans la liste ou pas.

 ```python
 students = [
    {"name": "Hermione", "house": "Gryffindor"},
    {"name": "Harry", "house": "Gryffindor"},
    {"name": "Ron", "house": "Gryffindor"},
    {"name": "Draco", "house": "Slytherin"},
]


def is_gryffindor(student):
    return student["house"] == "Gryffindor"

#is_griffindor sans paranthèses, car c'est filter qui appelle la fonction
gryffindors = filter(is_gryffindor, students)

for gryffindor in gryffindors:
    print(gryffindor["name"])
 ```

On peut se passer de la fonction "is_gryffindor" en utilisant la fonction lambda.

```python
gryffindors = filter(lambda s: s["house"] == "Gryffindor", students)
```

## dictionary comprehensions

Afin de créer un dictionnaire, jusqu'ici on pouvait utiliser une syntaxe comme celle là :

```python
students = ["Hermione", "Harry", "Ron"]

gryffindors = []

for student in students:
    gryffindors.append({"name": student, "house": "Gryffindor"})
```

On peut condenser ce code en utilisant la syntaxe dictionary comprehensions, qui est très similaire à la syntaxe list comprehensions.

```python
students = ["Hermione", "Harry", "Ron"]

gryffindors = [{"name": student, "house": "Gryffindor"} for student in students]
```

Ces deux opérations nous donneront effectivement le même résultat, une liste de dictionnaires : 
```shell
[{"name" : "Hermione", "house": "Gryffindor"}, {"name" : "Harry", "house": "Gryffindor"}, {"name" : "Ron", "house": "Gryffindor"}]
```

Si on veut simplement récupérer un dictionnaire qui a pour clef les noms des étudiants et pour valeur leur maison, on peut opter pour cette syntaxe :

```python
students = ["Hermione", "Harry", "Ron"]

gryffindors = {student: "Gryffindor" for student in students}
```

Cela retournera ce dictionnaire : 
```shell
{"Hermione": "Gryffindor", "Harry": "Gryffindor", "Ron": "Gryffindor"}
```

## enumerate

Si on souhaite énumérer des valeurs, en leur associant une position, on aurait pu créer une fonction dans ce genre :

```python
students = ["Hermione", "Harry", "Ron"]

for i in range(len(students)):
# i+1 nous permet de commencer au chiffre 1, au lieu de 0
    print(i + 1, students[i])
```

On peut utiliser enumerate pour simplifier un peu cette syntaxe :

```python
students = ["Hermione", "Harry", "Ron"]

for i, student in enumerate(students):
    print(i + 1, student)
```

## yield (Generators & Iterators)

docs.python.org/3/howto/functional.html#generators 

Lorsqu'une fonction doit traiter une quantité importante d'information, il se peut qu'au delà d'une certaine limite, l'ordinateur ou le serveur qui exécute le programme n'aie pas assez de mémoire pour retourner l'output massif de la fonction.

Pour exemple, nous utiliserons ce code, qui génère un nombre croissant de mouton à chaque itération, 0 mouton sur la première ligne, 1 mouton sur la deuxième, 2 moutons sur la 3ème etc...

```python
def main():
    n = int(input("What's n? "))
    for s in sheep(n):
        print(s)


def sheep(n):
    troupeau = []
    for i in range(n):
        troupeau.append("🐑" * i)
    return troupeau


if __name__ == "__main__":
    main()
```

Ce code est correct, et respecte les best practices mises en places jusqu'ici, c'est à dire qu'on sort nos opérations "complexes" de main en créant des fonctions annexes, ici sheep(), et que l'ont évite les side-effects directement dans ces fonctions annexes.

sheep() renvoie une valeur à main(), et c'est main() qui s'occupe d'imprimer cette valeur à l'écran.

Cependant, à partir d'une certaine valeur de n, l'ordinateur n'est plus capable de générer une aussi grosse quantité de données en une seule fois.

On vient utiliser le mot clef yield à l'intérieur de notre boucle, pour qu'à chaque itération la fonction renvoie les données associées à cette opération.
Rappel : on ne peut pas utiliser return à l'intérieur d'une boucle car cela stoppe la boucle à la fin de la première itération.

```python
def main():
    n = int(input("What's n? "))
    for s in sheep(n):
        print(s)


def sheep(n):
    for i in range(n):
        yield "🐑" * i


if __name__ == "__main__":
    main()
```

Generator =  la fonction qui retourne des iterators
Iterator = la/les valeur(s) de retour de yield