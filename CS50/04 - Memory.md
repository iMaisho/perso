# Memory

### Hexadecimal

On utilise une base 16 pour exprimer une valeur dans le système des couleurs, de 0 à F.

On peut donc définir une valeur entre 0 et 255 grâce à deux chiffres (de 00 à FF)

Pour définir une couleur on combine 3 de ces valeurs, respectivement pour le rouge, le vert et le bleu sous la forme #FFFFFF

Un des problèmes de cette notation est que 10 donne 1 fois 16 plus 0 fois 1, 10 = 16

Donc par convention, pour notifier que l'on est dans un système hexadécimal, on notera nos valeurs de la manière suivante :

0x10 = 16

On utiilise ces valeurs dans les programmes liés aux images et aux couleurs, mais c'est également comme ça que sont numérotés les zones de mémoires dans la RAM.

### Adresses mémoires

En C, on a deux nouveaux symboles qui nous permettent d'avoir des informations sur les adresses des variables ou autres contenues dans la mémoire.

& = "the adress of" operator

\* = "go to this adress" operator

```c
// Print la valeur d'une variable
printf("%i\n", n)

// Print l'adresse de cette variable
printf("%p\n", &n)
```

### Pointeurs

Un pointeur nous permet de stocker l'adresse d'une valeur grâce à la syntaxe suivante :

```c
int n = 50;
int *p = &n;

// Print l'adresse de la variable grâce au pointeur
printf("%p\n", p)

// Va a l'adresse et donne moi la valeur stockée à cet endroit
printf("%i\n", *p)
```

### Strings

Une string est en fait un pointeur qui indique le début d'une chaîne de caractères, et la fin de la chaîne est indiquée par le \0.

Donc string = char*

Dans le module <cs50.h>, pour que le compileur puisse comprendre le datatype string, voilà la simple ligne de code qui était intégrée

```c
typedef char *string;
```

On peut utiliser cette méthode pour renommer nos datatypes si besoin, par exemple :

```c
// Si on veut écrire integer à la place de int (inutile)
typedef int integer;

// Si on veut manipuler des bytes plus simplement
typedef uint8_t BYTE;
```

### Pointer arithmetic

On peut faire des maths sur des adresses, pour se déplacer dans la mémoire.

On peut partir d'un exemple simple, où l'on cherche à print tous les caractères d'une string. On pourrait l'écrire comme ceci : 

```c
#include <stdio.h>

int main(void)
{
    char *s = "HI!";
    printf("%c\n", s[0]);
    printf("%c\n", s[1]);
    printf("%c\n", s[2]);
}
```

On sait que *s va chercher le contenu de l'adresse du premier caractère de la chaîne. On peut donc manipuler la mémoire ainsi pour obtenir le même résultat

```c
#include <stdio.h>

int main(void)
{
    char *s = "HI!";
    printf("%c\n", *s);
    printf("%c\n", *(s + 1));
    printf("%c\n", *(s + 2));
}
```
Ce n'est pas forcément utile dans ce cas, mais cela démontre que l'on peut se déplacer dans la mémoire en utilisant des calculs mathématiques.

### String comparison

Si l'on compare les valeurs de deux int, on a pas de problème, car une variable int contient directement la valeur qu'on lui associe.

Cependant, si on veut comparer deux strings, on sait maintenant que la string contient en fait l'adresse de son premier caractère. Donc même si nos deux strings contiennent les mêmes caractères, elles sont stockées à des endroits différents de la mémoire, donc leurs adresses sont différentes.

C'est pour cela que l'on utilise la fonction strcmp, dans <string.h>

### String copy

Partons du code suivant : 

```c
#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <string.h>

int main(void)
{
    // Get a string
    string s = get_string("s: ");

    // Copy string's address
    string t = s;

    // Capitalize first letter in string
    t[0] = toupper(t[0]);

    // Print string twice
    printf("s: %s\n", s);
    printf("t: %s\n", t);
}
```

Ce programme induira un bug, car lorsque l'on copie s dans la string t, on ne copie pas les caractères en soit, mais bien le pointeur s qui donne l'adresse de la première lettre de la string. Donc si on modifie la string, on la modifie pour s et pour t, qui pointent tous les deux vers la même adresse mémoire.

On peut utiliser les fonctions "malloc" et "free", contenues dans <stdlib.h>

**malloc(n) :** Memory Allocate (Allouer de la mémoire) permet d'aller chercher une suite de n bytes disponibles dans la mémoire vive pour pouvoir y stocker des données. Cette fonction retourne l'adresse du premier byte de la suite.

```c
#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(void)
{
    char *s = get_string("s: ");

    // strlen retourne le nombre de caractères visibles, on ajoute 1 pour inclure "\0"
    char *t = malloc(strlen(s) + 1);

    // Copie chaque caractère, "\0" inclus. 
    // On définit n en amont, pour éviter d'appeler strlen à chaque itération de la boucle
    for (int i = 0, n = strlen(s); i < n + 1; i++)
    {
        t[i] = s[i];
    }

    t[0] = toupper(t[0]);

    printf("s: %s\n", s);
    printf("t: %s\n", t);
}
```

Si on est à cours de mémoire, malloc retournera NULL. On peut donc sécuriser notre programme en ajoutant :

```c
if (t == NULL)
{
    return 1;
}
```

Il existe une fonction pré-existante dans <string.h> qui permet de remplacer la boucle for qu'on a écrite précedemment : 
```c
#include <string.h>

strcpy(t, s);
```

**free(pointer) :** l'inverse de malloc, cela permet de libérer les bytes contenant des données dont on a plus besoin. C'est important pour éviter de surcharger la mémoire (ce qui ralentit l'ordinateur, et peut créer des bugs, voire des bugs graves)

Dans le cas de fonctions intégrées à <cs50.h>, la libération de la mémoire est déjà gérée donc il ne faut pas le faire, ça peut causer des problèmes.

Pour copier une chaîne de caractère et mettre le premier caractère de la copie en majuscules, cela nous donne donc :

```c

#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(void)
{
    // Get a string
    char *s = get_string("s: ");
    if (s == NULL)
    {
        return 1;
    }

    // Allocate memory for another string
    char *t = malloc(strlen(s) + 1);
    if (t == NULL)
    {
        return 1;
    }

    // Copy string into memory
    strcpy(t, s);

    // Capitalize copy
    if (strlen(t) > 0)
    {
        t[0] = toupper(t[0]);
    }

    // Print strings
    printf("s: %s\n", s);
    printf("t: %s\n", t);

    // Free memory
    free(t);
    return 0;
}
```

### Valgrind

Partons de ce bout de code (inutile en soit, qui n'existe que pour des raisons de compréhension) bugué : 

```c
#include <stdio.h>
#include <stdlib.h>

int main(void)
{
    int *x = malloc(3 * sizeof(int));
    x[1] = 72;
    x[2] = 73;
    x[3] = 33;
}
```

Ce bout de code permet d'allouer la taille de 3 ints (qui est typiquement 4 bytes par int). Il est donc équivalent à malloc(12), mais certains vieux systèmes allouaient moins de mémoires aux ints, donc passer par **sizeof()** permet à tous les systèmes d'allouer le bon nombre de bytes.
```c
int *x = malloc(3 * sizeof(int));
```

On a deux bugs dans ce programme : 

- Notre array étant 0-indexed, x[3] n'existe pas, car ce serait le 4ème élément de notre array composé de 3 éléments.
- On a pas libéré la mémoire allouée à ces variables.

Cependant lorsque l'on compile et qu'on exécute notre programme, on a pas de bug apparent.

```shell
valgrind ./programme
```
Cette ligne de commande nous permet de vérifier les erreurs liées à la mémoire dans notre programme.

On peut trouver dans le résultat de cette opération les lignes suivantes :

```shell
Invalid write of size 4
    at "adress": main (nom_programme.c:9)
 Address adress is 0 bytes after a block of size 12 alloc'd
 ...
```

Cette ligne d'erreur nous indique que la ligne 9 ne peut pas être exécutée, car on essaye d'écrire une valeur à un endroit de la mémoire qui n'a pas été alloué par malloc()

```shell
12 bytes in 1 blocks are definitely lost in loss record 1 of 1
    at adress: malloc(...)
    by adress: main (nom_programme.c:6)

LEAK SUMMARY:
    definitely lost : 12 bytes in 1 blocks
    ...
```

Ces lignes nous indique que cette mémoire a été définitivement perdue, car elle n'a pas été libérée après l'execution du programme.

(nom_programme:6) nous indique qu'il s'agit du chunck de mémoire alloué à la ligne 6 du programme.

On peut donc corriger notre code ainsi : 

```c
#include <stdio.h>
#include <stdlib.h>

int main(void)
{
    int *x = malloc(3 * sizeof(int));
    // 0-index
    x[0] = 72;
    x[1] = 73;
    x[2] = 33;
    // Free memory
    free(x);
}
```

### Garbage values

Une variable à laquelle on  donne un nom sans lui assigner de valeur obtient naturellement une place dans la mémoire, et donc une valeur de base qui était déjà stockée à cet endroit de la mémoire (du fait de l'utilisation de l'ordinateur).

On a déjà pu observer ce comportement en utilisant debug50.

### Swapping & Scope

Pour échanger les valeurs de deux variables, on utilise une 3ème variable temporaire pour stocker la valeur de la variable 1, la variable 1 prend la valeur de la variable 2, puis la variable 2 prend la valeur de la variable temporaire.

```c
void swap(int a, int b)
{
    int tmp = a;
    a = b;
    b = tmp;
}
``` 

Pourtant, dans le code suivant, la fonction ne fonctionne pas comme attendu :

```c
#include <stdio.h>

void swap(int a, int b);

int main(void)
{
    int x = 1;
    int y = 2;

    printf("x is %i, y is %i\n", x, y);
    swap(x, y);
    printf("x is %i, y is %i\n", x, y);
}

void swap(int a, int b)
{
    int tmp = a;
    a = b;
    b = tmp;
}
```

Cela est dû à la notion de scope. Lorsque l'on passe x et y dans la fonction swap, on passe en fait les valeurs de x et y, ce qui en crée une copie dans la mémoire.

![Alt text](https://cs50.harvard.edu/x/2024/notes/4/cs50Week4Slide163.png)

#### Passing by value

Lorsque main() est appelée, elle est ajoutée dans la stack, en bas de cette image, avec ses variables x et y.

Puis lorsque main() appelle swap(), swap est ajoutée dans la stack au dessus de main. Ses variables a et b on pris la valeur des arguments passés, respectivement x et y, mais dans des variables différentes, à des adresses mémoire différentes

On execute swap() pour échanger les valeurs de a et de b, puis la fonction disparait de la stack, vidant son cache. Donc les valeurs de a et de b ont été échangées, mais elles ont été supprimées de la mémoire à la fin de l'exécution de swap()

x et y n'ont donc pas échangé leurs valeurs.

#### Passing by reference / pointer

 Pour remédier à ce problème, on doit non pas passer les valeurs de x et de y, mais leurs adresses, pour permettre à swap() d'aller modifier directement les valeurs à ces adresses, effectivement modifiant les valeurs de x et de y.

 ```c
void swap(int *a, int *b)
{
    int tmp = *a;
    *a = *b;
    *b = tmp;
}
``` 

Il faudra donc passer l'adresse de chaque variable en tant qu'argument de la fonction swap, sous cette forme :

```c
swap(&x, &y)
```
Cela nous donnera cette fonction fonctionnelle :

```c
#include <stdio.h>

void swap(int *a, int *b);

int main(void)
{
    int x = 1;
    int y = 2;

    printf("x is %i, y is %i\n", x, y);
    swap(&x, &y);
    printf("x is %i, y is %i\n", x, y);
}

void swap(int *a, int *b)
{
    int tmp = *a;
    *a = *b;
    *b = tmp;
}
```

### Heap Overflow / Stack Overflow

Le heap est la zone de la RAM allouée à la data, comme les variables ou autres.

La stack est la zone de la RAM allouée aux fonctions.

Le heap et la stack s'ajoutent progressivement dans la mémoire dans des directions differentes, symbolisées par des flèches sur le schéma précédent.

Un **heap overflow** arrive lorsque l'on touche à des zones de la mémoire auxquelles on ne doit pas toucher.

Un **stack overflow** arrive lorsqu'on appelle trop de fonctions, et qu'on dépasse la limite de mémoire disponible.

Ces deux problèmes sont groupés sous le terme  **buffer overflows** 

### Scanf

Il est très difficile en C d'obtenir l'input d'un utilisateur de manière sécurisée. Il serait très facile pour l'utilisateur de provoquer un buffer overflow.

Néanmoins, essayons de comprendre comment les fonctions get_int et get_string incluses dans <cs50.h> fonctionnent.

