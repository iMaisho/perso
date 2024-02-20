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