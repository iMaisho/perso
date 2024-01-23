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