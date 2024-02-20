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