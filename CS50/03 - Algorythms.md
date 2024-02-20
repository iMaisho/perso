# Algorithms

La particularité d'un Array est qu'il est stocké de manière logique dans la RAM, c'est à dire que tous ses éléments sont placés les uns à côté des autres dans la RAM.

L'ordinateur ne peut en voir qu'un à la fois.

Imaginons que nous avons un array de 7 nombres, représenté par 7 boites fermées. Chaque boite contient un nombre, et nous cherchons le nombre 50. Nous nous servirons que cet exemple pour présenter différents algorithmes de recherche.

### Linear Search O(n)

De gauche à droite ou de droite à gauche, pas à pas dans l'array

En pseudo-code :

```
for i from 0 to n-1
    if 50 is in box[i]
    return true
return false
```

En C : 
```c
#include <cs50.h>
#include <stdio.h>

int main(void)
{
    // An array of integers
    int numbers[] = {20, 500, 10, 5, 100, 1, 50};

    // Search for number
    int n = get_int("Number: ");
    for (int i = 0; i < 7; i++)
    {
        if (numbers[i] == n)
        {
            printf("Found\n");
            return 0;
        }
    }
    printf("Not found\n");
    return 1;
}
```
### Binary search O(logn)

Divide and conquer. Si je sais que mon array est trié, je vais au milieu. En fonction de la valeur que j'y trouve, je cherche à droite ou à gauche.

En pseudo-code :
```
if no doors left
    return false
if 50 is behind doors[middle]
    return true
else if 50 < doors[middle]
    search doors[0] through doors[middle-1]
else if 50 > doors[middle]
    search doors[middle + 1] through doors[n-1]
```

### Running time

On fait une approximation mathématique pour nous donner un ordre d'idée du nombre d'étapes nécéssaires à l'execution d'un algorithme.

On définit l'efficacité d'un algorithme par son Ordre. On appelle ça "Big O Notation. C'est la limite haute de l'algorithme, c'est à dire le nombre d'étapes maximum qu'on peut avoir à effectuer.

- +++ PLUS LONG +++
- O(n²) : Quadratique
- O(n log n)
- O(n) - > Linéaire, lorsque j'ai n éléments, ça me prends n étapes
- O(log n) : Logarythmique
- O(1) : Constant. Pas forcément une étape, mais un nombre défini d'étapes peu importe le nombre d'éléments.
- --- MOINS LONG ---


Pour exprimer la limite basse, on utilise le symbole oméga Ω

Par exemple la recherche linéaire a une efficacité de O(n), mais une limite basse de Ω(1), car si on a de la chance on peut trouver du premier coup.
Même chose pour la recherche binaire, une efficacité de O(logn), mais une limite basse de Ω(1)

Si O et Ω sont égaux, on utilise le symbole theta Θ

Par exemple si je dois compter tous les élements d'une liste, je dois tous les compter un par un donc il n'y a pas de variance dans son efficacité. Elle aura une efficacité O(n) == Ω(n), donc Θ(n)

### Comparer des strings

Contrairement à des nombres, en C on ne peut pas rechercher une string dans un array grâce à cette syntaxe.

```c
if array[i] == string
```

On utilise la fonction strcmp de la librairie <string.h>

```c
if (strcmp(array[i], string) == 0)
```

### Data structures

Un array est pratique pour stocker des valeurs dans la RAM les unes à la suite des autres, cependant on peut vite se retrouver limité si on veut associer certaines valeurs entre elles.

On peut créer une structure de données pour lier des données entre elles, par exemple en représentant une personne dans une liste de contacts téléphoniques grâce à son nom et son numéro.

On utilisera la syntaxe suivante :

```c
typedef struct
{
    // données liées à la structure
    string name;
    string number;
} person;
// nom que l'on veut donner à la structure
```

On peut ensuite créer nos personnes grâce à cette syntaxe :

```c
person people[n];

people[0].name = "Antonin"
people[0].number = "06 00 00 00 00"
```

### Sorting

#### Selection sort ( O(n²) / Ω(n²) )

On avance dans l'array valeur par valeur, et on garde la plus petite que l'on a vu jusqu'ici en mémoire. Quand on arrive à la fin de l'array, on échange de place la plus petite valeur et la valeur à l'index i = nombre d'itérations déjà effectuée.
Ensuite on recommence l'opération à partir de i+1.

En pseudo-code :
```c
For i from 0 to n-1
    Find smallest number between numbers[i] and numbers[n-1]
    Swap smallest number with numbers[i]
```

Pour un array contenant n valeurs, on effectue (n-1) + (n-2) + (n-3) + ... + 1 comparaisons.
Soit **n(n-1)/2** ou **(n²/2 - n/2)**
On considère donc qu'il est d'ordre O(n²).

Même dans le cas où toutes les valeurs sont dans le bon ordre, vu qu'on garde en mémoire une seule des valeurs, tout l'algorithme s'exécutera.
Il est donc d'ordre Ω(n²)

#### Bubble sort ( O(n²) / Ω(n) )

Compare les valeurs adjacentes dans l'array, et échange leur place si celui de droite est plus petit que celui de gauche.

En pseudo-code :
```
Repeat n-1 times
    For i from 0 to n-2
        If numbers[i] and numbers[i+1] out of order
            Swap them
```

n-2 car on ne veut pas comparer la dernière valeur avec la suivante, car la suivante n'existe pas.

On effectura (n-1)*(n-1) opérations, donc cet algorithme est d'ordre O(n² également). 

Cependant on peut optimiser cet algorithme, car logiquement si à une itération on n'a besoin de ne faire aucun échange de position, l'array est déjà trié. On peut donc l'écrire ainsi :

```
Repeat n-1 times
    For i from 0 to n-2
        If numbers[i] and numbers[i+1] out of order
            Swap them
    If no swaps
        Quit
```

Cette amélioration permet, si l'array est déjà trié de limiter le nombre d'étapes de l'algorithme à n. Il est donc d'ordre Ω(n²).

### Recursion

La notion de récursivité intervient lorsqu'une fonction s'appelle elle même. Il faut être prudent en l'utilsant car cela peut créer des boucles infinies. Il est nécessaire d'avoir initié un "base-case" dans la fonction, qui permette de s'arrêter quand on a atteint notre but

```c

search :
// base case
if no doors left
    return false
if 50 is behind doors[middle]
    return true
else if 50 < doors[middle]
    // recursivité de la fonction search
    search doors[0] through doors[middle-1]
else if 50 > doors[middle]
    // recursivité de la fonction search
    search doors[middle + 1] through doors[n-1]
```

On va créer la fonction qui fabrique des pyramides de Mario grâce à cette méthode : 
```c
#include <cs50.h>
#include <stdio.h>

void draw(int n);

int main(void)
{
    int height = get_int("Height: ");
    draw(height);
}

void draw(int n)
{
    // If nothing to draw (BASE CASE)
    if (n <= 0)
    {
        return;
    }

    // On appelle la fonction pour dessiner une rangée plus petite
    draw(n - 1);

    // On finit par dessiner la rangée de taille n
    for (int i = 0; i < n; i++)
    {
        printf("#");
    }
    printf("\n");
}
```

#### Merge sort ( O(n logn) / Ω(n logn ))

Cet algorithme va séparer l'array en deux, trier les deux côtés puis merge ces deux côtés triés. Mais avant ça il va s'appeler lui même, pour séparer les deux moitiés en quatre moitiés etc... jusqu'à ce qu'une "moitié" ne soit plus qu'un nombre seul.

En pseudo code ça donne :

```
If only one number
    Quit
Else
    Sort left half of numbers
    Sort right half of numbers
    Merge sorted halves
```

Merge va comparer les deux premiers éléments de chaque moitié, et prendre le plus petit, encore et encore jusqu'à ce que les deux moitiées aient été combinées. Elles ont gardé leur ordre.

![Alt text](https://github.com/iMaisho/perso/blob/main/Ressources/Gifs/Merge%20Sort.gif?raw=true)


*représentation graphique de merge sort*

Merge sort est significativement plus rapide que les autres algorithmes de tri, car il effectue n(logn) opérations.