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
