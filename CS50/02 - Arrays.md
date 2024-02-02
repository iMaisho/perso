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