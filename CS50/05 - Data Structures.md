# Data Structures

### Abstract Data Types

#### Queues

FIFO = First In First Out

enqueue = entrer dans la queue
dequeue = sortir de la queue

```c
const int CAPACITY = 50;

typedef struct
{
    person people[CAPACITY];
    int size;
}
queue;
```

Cette structure a une capacité finie de 50 personnes en même temps dans la queue, et size nous permet de savoir combien de personnes sont déjà dedans (donc combien on peut encore ajouter)

#### Stacks

LIFO = Last In First Out

Par exemple, une boîte mail fonctionne sur le principe d'une stack, le dernier email est placé au dessus de la pile.

push = placer sur la pile
pop = enlever du haut de la pile

```c
const int CAPACITY = 50;

typedef struct
{
    person people[CAPACITY];
    int size;
}
stack;
```

On peut utiliser un code similaire pour définir la structure. Les différences seront présentes dans l'implémentation dans le code.

Imaginons que nous avons un array[3] et qu'on souhaite y ajouter une 4ème valeur.
On ne peut pas le faire directement car on ne sait pas ce qui est contenu dans l'octet contigu à l'array, et ça pourrait causer des problèmes de mémoire.

Une solution à ce problème pourrait être de copier l'array dans un array[4], puis d'ajouter notre 4ème valeur. C'est une approche qui fonctionne, mais ce n'est pas le meilleur design, car copier l'array est une fonction d'ordre O(n), ce qui est assez lent, et pendant un moment on utilise le double de la mémoire.

Une autre solution pourrait être de créer un array[1000] pour avoir de la place à ne plus savoir qu'en faire. Le problème est que ça utilise beaucoup de mémoire, et qu'on est pas certains de tout utiliser. De plus, si on a besoin de 1001 éléments on a le même problème que précédemment.

### Linked Lists

Pour pouvoir avoir une liste de taille variable, on peut utiliser des linked lists.

Ce sont en fait des chunks de mémoires qui ne sont pas contigus, contrairement aux arrays, mais que l'on vient relier entre eux à l'aide de pointeurs.

On s'évite tout le travail de copie de l'array expliqué plus haut, mais cela coûte un peu de mémoire, car pour chaque élément de la liste il faudra ajouter l'adresse du prochain élément.

Le dernier élément de la liste sera lié au pointeur NULL.

On appelle les éléments de la liste la data (ou les données), et les pointeurs la metadata (ou meta-données)

Le bloc formée par les données et la metadata s'appelle un node.

On peut définir sa structure en C comme cela : 

```c
typedef struct
{
    type data;
    node *next;
} node;
```

Cependant comme on appelle node à l'intérieur de la struct sans avoir terminé de la définir (son nom est à la dernière ligne), cela ne fonctionne pas.

On peut lui donner un nom à la première ligne pour corriger ce problème.

```c
typedef struct node
{
    type data;
     struct node *next;
} node;
```

La dernière liste permet de renommer "struct node" en "node" pour pouvoir l'écrire plus simplement dans le reste du code.

![Alt text](https://github.com/iMaisho/perso/blob/main/Ressources/Gifs/Linked%20Lists.gif?raw=true)
*Représentation pas à pas de l'implémentation d'une liste liée*

Note : La flèche -> permet de simplifier la syntaxe. Elle symbolise la flèche qui va du pointeur vers l'élément de la structure (ici un node) dont on veut changer la valeur.

```c
pointeur->nombre
// équivaut à
(*pointeur).nombre
```            

Qu'est ce que ça donne en code ?

```c
#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>

typedef struct node
{
    int number;
    struct node *next;
}
node;

int main(int argc, char *argv[])
{
    // Memory for numbers
    node *list = NULL;

    // For each command-line argument
    for (int i = 1; i < argc; i++)
    {
        // Convert argument to int
        int number = atoi(argv[i]);

        // Allocate node for number
        node *n = malloc(sizeof(node));
        if (n == NULL)
        {
            return 1;
        }
        n->number = number;
        n->next = NULL;

        // Prepend node to list
        n->next = list;
        list = n;
    }

    // Print numbers
    for (node *ptr = list; ptr != NULL; ptr = ptr->next)
    {
        printf("%i\n", ptr->number);
    }

    // Free memory
    node *ptr = list;
    while (ptr != NULL)
    {
        node *next = ptr->next;
        free(ptr);
        ptr = next;
    }
}
```

### Prepending list

La liste liée implémentée plus haut ajoute chaque nouvel élément au début de la liste. Ainsi un input de "1 2 3" créera une liste liée "3 2 1". 

C'est un algorithme d'ordre O(1), car peu importe la taille de la liste, ajouter un élément nous prendra un nombre fini déterminé d'étapes.

En revanche, rechercher une valeur dans cette liste liée utilisera un algorithme d'ordre O(n), car nous serons forcé de commencer au début de la liste pour pouvoir la parcourir. Il est donc impossible d'utiliser le Binary search (O(logn)) sur une liste liée (cf. 03 - Algorythms).

Les listes liées nous permettent d'éviter les problèmes des arrays liés à la mémoire en créant des listes dynamiques dont la taille change en fonction de nos besoins, mais cela a un coût en temps lorsque l'on doit chercher dans ces listes.

### Appending list

On peut modifier notre code pour faire en sorte que nos nouveaux éléments se retrouvent à la fin de la liste liée.

```c
#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>

typedef struct node
{
    int number;
    struct node *next;
}
node;

int main(int argc, char *argv[])
{
    // Memory for numbers
    node *list = NULL;

    // For each command-line argument
    for (int i = 1; i < argc; i++)
    {
        // Convert argument to int
        int number = atoi(argv[i]);

        // Allocate node for number
        node *n = malloc(sizeof(node));
        if (n == NULL)
        {
            return 1;
        }
        n->number = number;
        n->next = NULL;

        // If list is empty
        if (list == NULL)
        {
            // This node is the whole list
            list = n;
        }

        // If list has numbers already
        else
        {
            // Iterate over nodes in list
            for (node *ptr = list; ptr != NULL; ptr = ptr->next)
            {
                // If at end of list
                if (ptr->next == NULL)
                {
                    // Append node
                    ptr->next = n;
                    break;
                }
            }
        }
    }

    // Print numbers
    for (node *ptr = list; ptr != NULL; ptr = ptr->next)
    {
        printf("%i\n", ptr->number);
    }

    // Free memory
    node *ptr = list;
    while (ptr != NULL)
    {
        node *next = ptr->next;
        free(ptr);
        ptr = next;
    }
}
```

Cette nouvelle version sacrifie du temps à l'insertion de chaque élément, car on doit se rendre à la fin de la liste liée à chaque nouvel élement. Cet algorithme est d'ordre O(n).

### Sorted List

```c
#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>

typedef struct node
{
    int number;
    struct node *next;
}
node;

int main(int argc, char *argv[])
{
    // Memory for numbers
    node *list = NULL;

    // For each command-line argument
    for (int i = 1; i < argc; i++)
    {
        // Convert argument to int
        int number = atoi(argv[i]);

        // Allocate node for number
        node *n = malloc(sizeof(node));
        if (n == NULL)
        {
            return 1;
        }
        n->number = number;
        n->next = NULL;

        // If list is empty
        if (list == NULL)
        {
            list = n;
        }

        // If number belongs at beginning of list
        else if (n->number < list->number)
        {
            n->next = list;
            list = n; 
        }

        // If number belongs later in list
        else
        {
            // Iterate over nodes in list
            for (node *ptr = list; ptr != NULL; ptr = ptr->next)
            {
                // If at end of list
                if (ptr->next == NULL)
                {
                    // Append node
                    ptr->next = n;
                    break;
                }

                // If in middle of list
                if (n->number < ptr->next->number)
                {
                    n->next = ptr->next;
                    ptr->next = n;
                    break;
                }
            }
        }
    }

    // Print numbers
    for (node *ptr = list; ptr != NULL; ptr = ptr->next)
    {
        printf("%i\n", ptr->number);
    }

    // Free memory
    node *ptr = list;
    while (ptr != NULL)
    {
        node *next = ptr->next;
        free(ptr);
        ptr = next;
    }
}
```

Cet algorithme est aussi d'ordre O(n), car si le nombre est plus grand que tous les éléments de la liste il faudra la parcourir en entier pour le placer à la fin.

### Trees

Comme on l'a vu plus tôt, il y a des avantages et des inconvénients en termes de mémoire et de temps d'éxecution à utiliser des linked lists plutôt que des arrays, et vice-versa. C'est difficile de déterminer un vrai gagnant.

Et si on combinait le meilleur des deux mondes ?

Imaginons un array de taille 7 (bien pratique car possède des milieus bien définis à chaque fois qu'on veut le séparer en deux moitiées égales.)

La valeur 4 sera la racine de l'arbre, et sera liée à deux pointeurs, un à gauche et un à droite, qui pointeront vers 2 et 6, qui sont les milieus des deux moitiées restantes.

Ces deux valeurs seront liées à des pointeurs vers leurs enfants respectifs (1 et 3 pour 2, 5 et 7 pour 6).

On crée ce genre d'arbre généalogique jusqu'au "feuilles", qui sont les nodes qui n'ont plus d'enfants.

![AltText](https://github.com/iMaisho/perso/blob/main/Ressources/Images/Binary%20Search%20Tree.png?raw=true)

On peut implémenter cette structure grâce ce bout de code :

```c
typedef struct node
{
    int number;
    struct node *left;
    struct node *right;
} node;
```

Comme l'arbre est "trié" et que toutes les valeurs sont croissantes en parcourant l'arbre de gauche à droite, on peut chercher dans l'arbre en partant de la racine, en comparant la valeur que l'on cherche avec la valeur du node et en partant à gauche ou à droite en conséquence.

C'est un algorithme de recherche d'ordre O(logn), car le nombre d'étapes max est la hauteur de l'arbre.

Imaginons que nous cherchions à savoir si la valeur que l'on cherche est présente dans l'arbre :

```c
bool search(node *tree, int number)
{
    if (tree == NULL)
    {
        return false;
    }
    else if (number < tree->number)
    {
        return search(tree->left, number)
    }
    else if (number > tree->number)
    {
        return search(tree->right, number)
    }
    else
    {
        return true
    }
}
```

Une nuance à apporter dépend de l'ordre dans lequel on ajoute les valeurs à l'arbre. Si on ajoute nos valeurs dans un ordre croissant, nous obtiendrons une linked list déguisée, car on aura créé que des nodes vers la droite.

On peut régler ce problème en ajoutant des étapes à la création des nodes, pour créer un arbre équilibré.

Dans le cas où on crée des nodes de valeurs 1 puis 2 puis 3, il faudrait faire en sorte que la racine de l'arbre devienne 2 pour que l'arbre soit équilibré.

### Dictionaries

Comme en python, keys and values.

On ne verra pas ici comment les implémenter en C.

### Hashing

Imaginons qu'on souhaite réaliser une liste de contacts.
On peut combiner les arrays et les linked lists pour garder le meilleur des deux mondes.

L'idée serait d'avoir un array[26], dont chacun des éléments correspond théoriquement à une lettre de l'alphabet.

A chaque fois que l'on souhaiterai ajouter un élément à cette hash table, on choisirai l'élément de l'array correspondant à la première lettre du nom de l'élément, et on lierai les deux éléments. L'array contiendra donc le pointeur vers l'élément, qui serait un node à part, et ainsi de suite à chaque fois qu'on ajoute un élément avec une même lettre de départ.

On obtient donc un array de linked lists.

Dans le meilleur des cas, cet algorithme est d'ordre O(1), mais si tous les contacts commencent par la même lettre alors on se retrouve avec une simple linked list d'ordre O(n).

On peut essayer de résoudre ce problème en créant un array qui ne classe pas par la première lettre mais par les 3 premières par exemple, ce qui rends très improbable que tout le monde soit lié, mais c'est au sacrifice de la mémoire, car ça fait pow(26, 3) combinaisons possible, donc on est obligés de créer un array[17576].

Pour le premier exemple, chaque node serait défini ainsi :

```c
typedef struct node
{
    char *name;
    char *number;
    struct node *next;
} node;
```

Et la hash table serait définie ainsi :

```c
node *table[26];
```

Le hashing est donc l'idée générale de prendre un input, et de lui associer une valeur en fonction de cet input.

Lorsque l'on passe l'input "Mario" dans la fonction de hashage définie plus tôt, on obtient 12 (car M est la 13ème lettre de l'alphabet).

En code cette fonction pourra être implémentée comme ceci : 

```c
// Pour avoir accès à toupper()
#include <ctype.h>

// On ajoute unsigned pour éviter les valeurs négatives
// On ajoute const pour éviter que la valeur du mot soit modifiée
unsigned int hash(const char *word)
{   
    // On met la lettre en majuscule, et on en soustrait la valeur unicode du A majuscule pour obtenir une valeur entre 0 et 25.
    return toupper(word[0]) - "A";
}

```

#### Différence entre la théorie et la pratique

Cet algorithme est de l'odre de O(n), car théoriquement si tous nos contacts ont le même output après avoir été hashé, on obtient une linked list de n éléments.

Mais dans la réalité, on se rend bien compte que c'est très improbable. En réalité on pourrait définir la fonction avec les termes O(n/26), dans le cas où tous les noms sont équitablement répartis. C'est quand même 26 fois plus rapide de rechercher un élément dans une hash table que dans une linked list. Donc ça reste utile dans le monde réel, même si l'ordre de grandeur reste le même.

### Tries

Un try est un tree of arrays.

Un exemple classique est d'utiliser des array[25] pour chaque lettre de l'alphabet, et de hash chaque lettre une à une pour se diriger vers les feuilles.

Vu que chaque élément diffère, chaque élément aura tracé son propre chemin, de lettre en lettre, au travers le l'arbre.

Comme la majorité des arrays contiennent des valeurs "NULL" lorsqu'ils ne sont pas utilisés, on doit indiquer avec une valeur spéciale la fin d'un mot.

En code ça donnerai :

```c
typedef struct node
{
    struct node *children[26];
    char *number;
} node;
```

Rechercher un élément dans cette structure est d'ordre O(1).