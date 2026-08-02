# Introduction

## Search Problems

**Agent :** Une représentation de l'acteur pour notre modèle (une voiture pour maps) qui perçoit son environnement et agit en conséquence.

**State :** Un état, une configuration de l'agent et de son environnement.

**Action :** Un choix qui peut être fait dans un état donné. Actions(s) est le set d'actions qu'on peut éxécuter dans un état s

**Result :** Une fonction qui prend un état et une action, et output un nouvel état.

**State Space :** Le set de tous les états atteignables depuis l'état initial par n'importe quelle séquence d'actions. On peut représenter tous ces états et leurs liens (les actions) grâce à un graphe.

**Goal Test :** Une manière de déterminer qu'un état est l'état qu'on cherchait à atteindre.

**Path cost :** Un coût associé à un chemin, utilisé lorsqu'on cherche à optimiser la façon d'atteindre notre but. On associe une valeur numérique (en temps, en distance...) à chacune de nos actions. On peut parfois se contenter d'avoir un coût constant pour toutes les actions, afin de réduire le nombre d'actions.

**Solution :** Une séquence d'action qui passe de l'état initial à l'état désiré. Une solution optimale est une solution qui a le path cost le plus bas parmi toutes les solutions possibles.

**Node (noeud) :** Une structure de données qui monitore : - Un état - Un parent (le noeud qui a généré ce noeud) - Une action (qu'on a appliqué au parent pour obtenir ce noeud) - un coût (de l'état initial jusqu'à ce noeud)

### Approche

Frontière : La structure de données qui contient toutes les options disponibles dans un état donné.

On commence avec une frontière qui contient l'état initial.
On commence avec un set vide de noeuds explorés
Loop : 
- Si la frontière est vide, il n'y a pas de solution - Retirer un noeud de la frontière - Si ce noeud est l'objectif, on a trouvé la solution 
- Ajouter le noeud au set des noeuds explorés 
- Expand le noeud : Ajouter tous les noeuds qui ne sont pas dans le set de noeuds explorés atteignables depuis ce noeud à la frontière.

Si on utilise une stack (LiFo Last IN First OUT) pour la frontière, on privilégie la recherche en profondeur (on va aller tout en bas de l'arbre avant de passer à une nouvelle branche) : c'est la **depth-first** search (DFS).

Si on utilise une queue (FiFo), on privilégie la recherche en surface, en largeur : c'est la **breadth-first** search (BFS).

BFS permet de trouver une solution optimale à tous les coups, mais est plus coûteux en mémoire en général.

### Informed Search

La stratégie qu'on a mis en place jusqu'ici était indépendante du problème à traiter. Elle n'avait pas connaissance de ce problème, et utilisait une méthode générique.

On peut essayer d'optimiser la résolution de problème en prenant en compte les spécificités du problème à résoudre.

Par exemple pour la résolution de labyrinthes, on pourrait partir du postulat qu'explorer les cases qui sont plus proches de l'objectif sera globalement plus efficace que l'inverse. Ca ne sera pas vrai dans toutes les situations, mais ça pourrait l'être dans une majorité des cas.

#### Greedy best-first search GBFS

Cet algorithme étend le noeud qui est le plus proche de l'objectif, en l'estimant grâce à une fonction heuristique h(n)

Toujours dans notre exemple de labyrinthe à cases, on prendrait le nombre total de cases en allant jusqu'à la hauteur de l'objectif plus le nombre de cases pour aller jusqu'à sa position horizontale. Ca s'appelle la _Manhattan Distance_

Cette fonction heuristique est une estimation, elle ne sera pas toujours correcte, mais elle permet de faire les choix les plus probables lorsqu'on arrive à une intersection.

La solution trouvée ne sera pas forcément optimale, car l'algorithme fait des choix informés de manière locale. C'est pour ça qu'on l'appelle _Greedy_.

#### A\* search

Cet algorithme étend le noeud qui a la plus basse valeur de g(n) + h(n).
_g(n) = le coût pour atteindre le noeud_
_h(n) = le coût estimé par la fonction heuristique pour atteindre l'objectif_

Cela permet de déterminer à chaque étape après une décision initiale si ça vaut le coup de continuer sur le chemin choisi initialement, ou s'il vaut mieux revenir sur la décision initiale pour explorer un autre chemin.

Cet algorithme trouve la solution optimale à deux conditions : 
    - **h(n) est admissible** : Il ne surestime jamais le coût pour atteindre l'objectif. Il peut être exact ou sous-estimer. - **h(n) est cohérent** : Quand on paye _c_ pour avancer, l'estimation heuristique ne peut pas descendre de + de c (par exemple, on est à 5 pas de l'objectif, on avance de 1, l'enfant ne peut pas être à moins de 4 pas de l'objectif). Par contre c'est asymétrique, dans le même exemple, l'enfant peut être à 8 pas de l'objectif sans casser la cohérence.

### Adversarial Search

Jusqu'ici on s'intéressait à des problèmes où l'agent était seul face au problème. Mais on peut imaginer des cas où des agents avec des buts divergents doivent "s'affronter" pour atteindre leur objectif.

Par exemple dans le jeu de morpion.

#### Minimax

On assigne une valeur à chaque issue de partie (-1 pour victoire de O, 0 pour nulle, 1 pour victoire de X)
X est le **MAX** player, il veut maximiser le score
O est le **MIN** player, il veut minimiser le score

S0 = état initial
Player(s) : le joueur dont c'est le tout
Actions(s) : retourne les coups légaux
Result(s,a) : l'état de retour en appliquant l'action *a* à l'état *s*
Terminal(s) : vérifie si l'état *s* est une partie terminée
Utility(s) : valeur finale de l'état *s* terminal

On a une méthode pour créer un graphe générique représentant les différents états d'une partie à deux joueurs au tour par tour.
Quand c'est le tour du MAX player, on le représente par un triangle vert pointant vers le haut, quand c'est le tour du MIN player, on le représente par un triangle rouge vers le bas.
On va alterner les couche de notre arbre de probabilité avec des flèches rouges et vertes, et chaque flèche portera le score le plus haut pour les vertes et le plus bas pour les rouges de ses enfants (les actions possibles) en partant du bas de l'arbre.

L'algorithme ressemble à ça : 
    Dans un état donné *s* :
    - MAX choisit une action a dans Actions(s) qui produit la plus grande valeur dans MIN-Value(Result(s,a)), en gros l'action qui résulte en l'état qui produit la MIN-Value la plus haute, autrement dit dont les actions rendues disponibles au MIN player lui permettront de minimiser le moins possible.
    - MIN fait la même chose dans l'autre sens (cherche à atteindre l'état qui permet au MAX player de maximiser le moins possible au tour suivant)

```
MAX-Value(state) :
    if Terminal(state):
        return Utility(state);
    else:
        v = -inf
        for action in Action(state)
            v = Max(v, MIN-Value(Result(state, action)))
        return v
```

```
MIN-Value(state) :
    if Terminal(state):
        return Utility(state);
    else:
        v = inf
        for action in Action(state)
            v = Min(v, MAX-Value(Result(state, action)))
        return v
```

En gros c'est de la récursivité qui s'applique jusqu'à atteindre le fond de notre arbre, sauf qu'au lieu de s'appeler soit même elle appelle la fonction opposée, et alterne jusqu'à trouver un état terminal.

Pour une game de tic-tac-toe avec 9 coups possibles au départ et un coup possible de moins à chaque tour, l'arbre est relativement petit (de l'ordre de 9! combinaisons terminales (Un peu moins de 400k)). Mais pour des jeux beaucoup plus complexes, cet algorithme serait extrêmement coûteux en temps et en mémoire.

On peut optimiser cet algorithme très simplement :
    Mettons qu'en tant que MAX player on étudie le coup de notre adversaire, et que l'étude d'une première action donne un état qui lui permet de minimiser la game avec un score de 4 (on regarde toutes les options qui s'offrent à lui, comme on l'a fait jusqu'ici)
    Pour les actions suivantes, si on trouve un coup qui lui permet de faire moins que 4, on peut arrêter d'observer l'état donné par cette action, car peu importe les autres coups disponibles, vu qu'il joue de manière optimale également on sait qu'il pourra faire 3 ou moins. Ca nous évite de calculer tout un tas de possibilités.

Ca s'appelle **Alpha-Beta Pruning** (Ou élagage Alpha-Beta). Alpha est notre 4, Beta est notre 3, et on élague notre arbre de tous les enfants qui n'ont pas besoin d'être calculés.

#### Depth-limited Minimax

Comme on l'a dit, sur un jeu de tic tac toe c'est relativement peu coûteux en mémoire. Pour un jeu comme les échecs, on estime le nombre de parties à environ 10^29000.. Ca prendrait un peu trop de temps et de mémoire pour résoudre le jeu.

Entre en jeu une nouvelle optimisation, qui calcule l'arbre jusqu'à une certaine profondeur seulement. La partie ne sera toujours pas terminée, mais il faudra quand même assigner une valeur à tous les états d'arrivée. Ce sera moins précis que notre approche précédente, mais on doit créer une fonction qui permet d'évaluer cette valeur pour un état donné.

C'est la qualité de cette fonction d'évaluation qui déterminera la qualité de notre intelligence artificielle.


