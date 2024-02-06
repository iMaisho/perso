# Week 2

### Compiling

Depuis le début du cours, on tapait "make" dans le terminal de commande pour compiler nos programmes, et les traduire en langage machine.

En réalité, cette fonction nous permet d'utiliser le compiler clang, pour C language, simplement, sans avoir à se préoccuper d'ajouter des CLA (command line arguments) pour configurer notre programme compilé (lui donnner un nom, inclure les librairies etc...)

En réalité, la compilation n'est qu'une étape de la traduction entre le langage et le langage machine.

#### Preprocessing

Chaque ligne commençant par un #include en C est appelée un "preprocessor directive".
A cette étape, le programme de compilation va aller chercher le fichier qui est cité, et dans ce fichier va récupérer les prototypes des fonctions qui ont été écrites, pour pouvoir les utiliser dans notre code.

```c
#include <cs50.h>
// devient
string get_string(string prompt);
```

#### Compiling

Le programme de compilation va traduire notre programme en assembly, qui est un langage de programmation low-level (plus proche du langage machine)

```assembly
...
main:                                   # @main
    .cfi_startproc
# BB#0:
    pushq    %rbp
.Ltmp0:
    .cfi_def_cfa_offset 16
.Ltmp1:
    .cfi_offset %rbp, -16
    movq    %rsp, %rbp
.Ltmp2:
    .cfi_def_cfa_register %rbp
    subq    $16, %rsp
    xorl    %eax, %eax
    movl    %eax, %edi
    movabsq    $.L.str, %rsi
    movb    $0, %al
    callq    get_string
    movabsq    $.L.str.1, %rdi
    movq    %rax, -8(%rbp)
    movq    -8(%rbp), %rsi
    movb    $0, %al
    callq    printf
    ...
```

#### Assembling

Le programme de compilation traduit l'assembly en langage machine binaire.

#### Linking

Lorsque l'on crée un fichier en C, on va également utiliser tous les fichiers en C appelés par les preprocessing directives.

```c
#include <cs50.h>
```
Implique qu'il existe un fichier cs50.c, qui passera par ces étapes pour être traduit en langage machine.

A l'étape du linking, le programme de compilation va créer un seul fichier en language machine, qui contient tous les programmes utilisés en plus de notre propre programme.

### Debugging

Pour nous aider à debugger notre code, on peut utiliser printf pour voir ce qui se passe. Ce processus peut devenir vite compliqué et bazardeux.

CS50 nous offre la possibilité de débugger notre code en mettant un ou des breakpoints dans notre fichier, et en exécutant cette commande

```shell
debug50 ./file
```

### Arrays

On peut créer une liste de valeurs (du même type en C) en utilisant la syntaxe suivante :

```c
type name[N]
```

N est le nombre d'éléments dans la liste. Il doit être prévu à l'avance par le compileur.

Une pratique commune est de le définir en tant que constante globale, pour 
- pouvoir l'appeler à différents endroit de notre code
- pouvoir modifier sa valeur à un seul endroit du code
- pouvoir lui donner un nom pour que sa présence dans le code face sens (aka éviter les nombres magiques)

```c
const int NUMBER = 3
```

On écrit son nom en majuscule pour rendre clair le fait que ce soit une constante, et qu'on ne veut pas la modifier dans le code.

### Command Line Arguments

Pour pouvoir utiliser les CLA dans nos fonctions, on utilise cette syntaxe :

```c
int main (int argc, string argv[])
```

argc correspond au nombre de CLA, et argv[] est la liste des CLA tapés par l'utilisateurs

```c
#include <cs50.h>
#include <stdio.h>

int main(int argc, string argv[])
{
    printf("hello, %s\n", argv[1]);
}
```
argv[0] est le nom du programme
Si aucun argument n'est donné, la valeur par défaut est (null)

On peut utiliser une boucle pour prendre un nombre indéfini de CLA.


### Exit Status

En C, un programme qui fonctionne retourne 0, c'est pour cela que la fonction main est définie comme cela :
```c
int main(void)
```

Pour créer une erreur, on peut retourner une valeur à la main.

```c
#include <cs50.h>
#include <stdio.h>

int main(int argc, string argv[])
{
    if (argc != 2)
    {
        printf("Missing command-line argument\n");
        return 1;
    }
    printf("hello, %s\n", argv[1]);
    return 0;
}
```

En tapant **echo $?** dans le terminal, on peut voir la valeur qu'a renvoyé main à la dernière exécution de notre programme. C'est un outil de plus à notre disposition pour débugger, ou bien on pourra l'utiliser dans des programmes de test.

### Cryptographie

On appelle ciphertext un texte qui est passé dans un cipher pour être crypté.

La plupart des cipher prennent en input le texte que l'on veut crypté et une clé de cryptage.

Exemple du cryptage de césar qui prends une clé entre 1 et 25 et qui décalle les lettres dans l'alphabet de n lettres.

Pour décrypter on fait le chemin inverse.