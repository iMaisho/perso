# La programmation fonctionnelle avec Scala
Yidhir MOUDOUB
*yidhir.moudoub@outlook.com*

Le petit frère fonctionnel de Java

*Notes rédigées à partir des slides 1 à 20 (Prérequis → Session 3). Les exercices sont dans [Exercices/](Exercices/), un dossier par exercice.*

---

# Prérequis

Le cours part du principe qu'on connaît déjà :
- Au moins un langage de haut niveau (Python dans mon cas)
- Les structures de données de base : listes, dictionnaires (maps), ensembles (sets)
- Les bases de la programmation orientée objet (classes, instances, méthodes)

Connaître Java (ou un autre langage de la JVM) aide, mais ce n'est pas obligatoire.

---

# Pourquoi la programmation fonctionnelle ?

## Impératif vs fonctionnel

Il existe deux grandes manières de penser un programme.

**Programmation impérative :** On décrit *comment* faire, étape par étape. On manipule un **état mutable** (des variables qu'on modifie au fil du programme), des boucles, et on produit des **effets de bord**.

**Programmation fonctionnelle :** On décrit *ce qu'on veut calculer*. On manipule des **valeurs immuables**, des **expressions** et des **fonctions pures**, qu'on compose entre elles.

Prenons un exemple concret : faire la somme des carrés des nombres pairs d'une liste.

En impératif (en Python pour l'exemple) :
```python
total = 0
for n in nums:
    if n % 2 == 0:
        total += n * n
```
On crée une variable, on la modifie à chaque tour de boucle, et à la fin elle contient le résultat. Pour comprendre ce que fait le code, il faut le "rejouer" dans sa tête ligne par ligne.

En fonctionnel (en Scala) :
```scala
val total = nums.filter(n => n % 2 == 0).map(n => n * n).sum
```
On lit directement la recette : *garde les pairs, mets-les au carré, fais la somme*. Aucune variable n'est modifiée, aucune boucle n'est écrite à la main.

### Les notions clés

**Effet de bord (side effect) :** Tout ce qu'une fonction fait *en plus* de renvoyer une valeur : modifier une variable extérieure, écrire dans un fichier, afficher dans la console, faire une requête réseau...

**Fonction pure :** Une fonction qui :
1. Renvoie toujours le même résultat pour les mêmes arguments
2. N'a aucun effet de bord

```scala
def add(a: Int, b: Int): Int = a + b   // pure

var counter = 0
def addAndCount(a: Int, b: Int): Int = {
  counter += 1                          // effet de bord : modifie l'extérieur
  a + b
}
```

**Transparence référentielle :** Conséquence directe des fonctions pures : on peut remplacer un appel de fonction par son résultat sans changer le comportement du programme. `add(2, 3)` peut être remplacé par `5` partout. C'est ce qui rend le code facile à raisonner, à tester et à refactorer.

**Immuabilité :** Une valeur, une fois créée, ne change plus. Si on veut une version "modifiée", on en crée une nouvelle.

### Pourquoi c'est intéressant

- **Composable :** De petites fonctions pures s'emboîtent comme des Lego pour former des traitements complexes (c'est ce qu'on appellera les *pipelines*).
- **Testable :** Une fonction pure se teste sans rien mettre en place : on lui donne une entrée, on vérifie la sortie.
- **Adapté au parallélisme :** C'est l'argument principal. Quand plusieurs threads modifient la même variable en même temps, on a des *race conditions* (deux threads lisent `counter = 5`, les deux écrivent `6`, on a perdu un incrément). Si rien n'est jamais modifié, ce problème n'existe tout simplement pas. C'est pour ça que Spark, qui distribue les calculs sur des dizaines de machines, repose sur ce paradigme.

## Pourquoi Scala ?

- **Hybride :** Scala combine programmation orientée objet ET programmation fonctionnelle. On n'est pas obligé d'être 100% fonctionnel (contrairement à Haskell), ce qui facilite la transition.
- **JVM :** Scala est compilé en bytecode Java et tourne sur la Java Virtual Machine. On peut donc utiliser n'importe quelle bibliothèque Java directement.
- **Système de types fort :** Le compilateur vérifie les types avant l'exécution. Beaucoup d'erreurs qu'on découvrirait en Python au moment où le code plante sont détectées dès la compilation.
- **Concis :** Grâce à l'inférence de types et à une syntaxe expressive, on écrit beaucoup moins de code "de cérémonie" (*boilerplate*) qu'en Java.
- **Industrie :** Scala est le langage natif d'**Apache Spark** (traitement de données distribuées), mais aussi d'Akka (systèmes concurrents) et de Play Framework (web).

*Il existe deux versions majeures : Scala 2 (2.13 étant la dernière) et Scala 3, sortie en 2021. La syntaxe qu'on voit en cours fonctionne dans les deux. Scala 3 permet en plus une syntaxe sans accolades basée sur l'indentation (façon Python), mais on reste sur les accolades ici.*

---

# Session 1 — Bases de Scala

## Structure d'un programme

Tous les exercices commencent par :
```scala
object Main extends App {
  println("Hello")
}
```

**object :** Déclare un *singleton*, c'est-à-dire une classe qui n'a qu'une seule instance, créée automatiquement. Scala n'a pas de mot-clé `static` comme Java : tout ce qui serait statique en Java va dans un `object`.

**extends App :** `App` est un trait (une sorte d'interface) fourni par Scala. En héritant de `App`, tout le corps de l'objet devient le point d'entrée du programme : pas besoin d'écrire la fonction `main` à la main.

Sans `App`, on écrirait l'équivalent de Java :
```scala
object Main {
  def main(args: Array[String]): Unit = {
    println("Hello")
  }
}
```

Et en Scala 3, on peut juste annoter une fonction :
```scala
@main def hello(): Unit = println("Hello")
```

*Petite particularité : dans un `object Main extends App`, on peut appeler une fonction définie plus bas dans le corps de l'objet (c'est ce qu'on fait dans tous les exercices : on appelle `play(...)` avant d'avoir écrit `def play`). Les `def` sont des membres de l'objet, ils existent dès sa création. En revanche une `val` utilisée avant sa déclaration vaudra encore `null` ou `0`.*

## val vs var

**val :** Déclare une valeur **immuable**. Une fois assignée, on ne peut plus la réassigner. C'est le choix par défaut en programmation fonctionnelle.
```scala
val name = "Alice"
name = "Bob"   // ERREUR de compilation : reassignment to val
```

**var :** Déclare une variable **mutable**, qu'on peut réassigner. À utiliser avec parcimonie, uniquement quand on en a vraiment besoin (et c'est plus rare qu'on le pense).
```scala
var count = 0
count = count + 1   // OK
count += 1          // OK aussi
```

**Attention à la nuance :** `val` rend la *référence* immuable, pas forcément l'objet pointé. Si on met un objet mutable dans une `val`, on ne peut pas réassigner la `val`, mais on peut modifier le contenu de l'objet :
```scala
import scala.collection.mutable.ArrayBuffer
val buffer = ArrayBuffer(1, 2, 3)
buffer += 4          // OK : on modifie le contenu
buffer = ArrayBuffer() // ERREUR : on réassigne la val
```
C'est pour ça qu'en Scala on combine `val` **et** collections immuables (celles par défaut) pour avoir une vraie immuabilité.

Règle simple : **toujours écrire `val`, et ne passer en `var` que si le compilateur nous y oblige et qu'on n'a pas trouvé de manière fonctionnelle de faire.**

## Types et inférence

Scala est **statiquement typé** : chaque valeur a un type connu à la compilation. Mais on n'est pas obligé de l'écrire, le compilateur le devine (**inférence de types**) :
```scala
val x = 42          // Int (inféré)
val x: Int = 42     // Int (annotation explicite)
val pi = 3.14       // Double
val ok = true       // Boolean
```

La syntaxe est `nom: Type`, le type vient **après** le nom (l'inverse de Java/C).

Les types de base :

| Type | Exemple | Remarque |
|---|---|---|
| `Int` | `42` | Entier 32 bits |
| `Long` | `42L` | Entier 64 bits (utilisé pour les timestamps) |
| `Double` | `3.14` | Flottant 64 bits |
| `Boolean` | `true` / `false` | |
| `Char` | `'a'` | Un seul caractère, guillemets simples |
| `String` | `"abc"` | Guillemets doubles |
| `Unit` | `()` | "Pas de valeur intéressante", l'équivalent de `void` |

**Unit :** Le type de retour des fonctions qui ne servent qu'à produire un effet de bord (comme `println`). Il n'a qu'une seule valeur possible, notée `()`. Contrairement à `void` en Java, c'est un vrai type avec une vraie valeur, ce qui garde la règle "tout renvoie quelque chose" cohérente.

Quand annoter explicitement ? L'usage est : on laisse l'inférence faire pour les variables locales, et on **annote toujours le type de retour des fonctions publiques** (ça sert de documentation et ça évite qu'un changement dans le corps change silencieusement le type).

## Les fonctions

On déclare une fonction avec `def` :
```scala
def add(a: Int, b: Int): Int = {
  a + b
}
```
- Les paramètres ont **obligatoirement** un type annoté (le compilateur ne peut pas le deviner).
- Le type de retour vient après `:` (il peut être inféré, mais on l'écrit par bonne pratique).
- Le `=` introduit le corps de la fonction.
- **Pas de `return` :** la valeur renvoyée est la **dernière expression** du bloc. Le mot-clé `return` existe mais est fortement déconseillé en Scala.

Si le corps tient en une expression, les accolades sont optionnelles :
```scala
def add(a: Int, b: Int): Int = a + b
def square(x: Int): Int = x * x
```

## Interpolation de chaînes et I/O

**Interpolation s :** On préfixe la chaîne par `s` et on insère des valeurs avec `$` :
```scala
val name = "Alice"
val age = 30
println(s"Hello $name")                // Hello Alice
println(s"Dans un an : ${age + 1} ans") // Dans un an : 31 ans
```
Pour une simple variable, `$name` suffit. Dès qu'on veut une **expression** (un calcul, un appel de méthode, un accès `obj.champ`), il faut les accolades : `${...}`. Sans elles, `s"$user.name"` insère `user` puis le texte littéral `.name`.

C'est l'équivalent des f-strings de Python (`f"Hello {name}"`).

Il existe deux autres interpolateurs utiles :
```scala
val pi = 3.14159
println(f"Pi vaut $pi%.2f")   // Pi vaut 3.14   (formatage façon printf, vérifié à la compilation)
println(raw"a\nb")            // a\nb           (les échappements ne sont pas interprétés)
```

**Sortie standard :**
- `println(x)` affiche `x` suivi d'un retour à la ligne
- `print(x)` affiche sans retour à la ligne

**Entrée standard :**
```scala
import scala.io.StdIn

val input = StdIn.readLine()       // lit une ligne, renvoie une String
val n = StdIn.readLine().toInt     // conversion en entier (lève une exception si ce n'est pas un nombre)
val n2 = StdIn.readInt()           // raccourci
```

## Tout est une expression

C'est **LE** concept fondamental de cette session, et le prof l'a passé un peu vite.

**Instruction (statement) :** Un morceau de code qui *fait* quelque chose mais ne *vaut* rien. En Python ou Java, `if` est une instruction.

**Expression :** Un morceau de code qui *s'évalue en une valeur*. `2 + 3` est une expression qui vaut `5`.

En Scala, **presque tout est une expression**, y compris `if/else` :
```scala
val abs = if (x > 0) x else -x
```
Le `if` renvoie directement une valeur, qu'on stocke dans `abs`. C'est l'équivalent du ternaire `x > 0 ? x : -x` des autres langages, mais en plus lisible et sans syntaxe spéciale.

Comparons avec la façon impérative :
```scala
var abs = 0
if (x > 0) abs = x else abs = -x
```
On est obligé de déclarer une `var` et de la modifier. Avec le `if`-expression, on a une `val` : plus sûr et plus court.

Ça marche aussi avec des `else if` en chaîne :
```scala
val label =
  if (n < 0) "négatif"
  else if (n == 0) "nul"
  else "positif"
```

**Les blocs aussi sont des expressions :** un bloc `{ ... }` vaut la valeur de sa dernière ligne.
```scala
val result = {
  val a = 10
  val b = 20
  a + b      // le bloc vaut 30
}
```
C'est d'ailleurs exactement pour ça que les fonctions n'ont pas besoin de `return` : le corps d'une fonction est un bloc, et un bloc vaut sa dernière expression.

*Et un `if` sans `else` ? Il vaut `Unit` quand la condition est fausse, donc son type global devient `Unit` (ou `Any`) : inutilisable comme valeur. Si on veut une valeur, on met toujours un `else`.*

## Boucles for et intervalles

**Intervalles (Range) :**
```scala
1 to 10      // 1, 2, ..., 10     (borne supérieure INCLUSE)
1 until 10   // 1, 2, ..., 9      (borne supérieure EXCLUE, comme range(1, 10) en Python)
1 to 10 by 2 // 1, 3, 5, 7, 9
10 to 1 by -1 // 10, 9, ..., 1
```
`until` est pratique pour parcourir des indices : `0 until list.length`.

**Boucle for :**
```scala
for (i <- 1 to 10) println(i)
```
Se lit "pour chaque `i` **pris dans** `1 to 10`". La flèche `<-` s'appelle un **générateur**. On peut itérer sur n'importe quelle collection, pas seulement des intervalles :
```scala
for (name <- List("Alice", "Bob")) println(s"Hello $name")
```

On peut ajouter des **gardes** (filtres) et plusieurs générateurs (boucles imbriquées) :
```scala
for (i <- 1 to 10 if i % 2 == 0) println(i)  // 2, 4, 6, 8, 10

for {
  i <- 1 to 3
  j <- 1 to 3
} println(s"$i x $j = ${i * j}")               // équivalent de deux boucles imbriquées
```

**for / yield (for-comprehension) :** Sans `yield`, une boucle `for` ne renvoie rien (`Unit`), elle ne sert qu'à produire des effets de bord (afficher...). Avec `yield`, elle **construit et renvoie une nouvelle collection** :
```scala
val squares = for (i <- 1 to 5) yield i * i
// Vector(1, 4, 9, 16, 25)

val evens = for (n <- List(1, 2, 3, 4) if n % 2 == 0) yield n * 10
// List(20, 40)
```
C'est l'équivalent des list comprehensions de Python (`[i * i for i in range(1, 6)]`).

*En coulisses, le compilateur transforme un `for/yield` en appels à `map`, `filter` (et `flatMap` quand il y a plusieurs générateurs), qu'on verra en Session 3. Ce n'est qu'une syntaxe plus lisible pour la même chose.*

**while :** Existe, mais n'est utile qu'avec des `var` (la condition doit bien changer à un moment). À éviter en style fonctionnel.
```scala
var i = 0
while (i < 3) { println(i); i += 1 }
```

**Et break ?** Scala n'a **pas** de mot-clé `break`, justement parce qu'on n'est pas censé en avoir besoin en fonctionnel. Il existe `scala.util.control.Breaks` pour le simuler (fonctionne en lançant une exception en interne), mais c'est généralement le signe qu'une méthode de collection ferait mieux le travail (`takeWhile`, `find`, `exists`, `span`...). On en a un exemple dans l'exercice 02.

---

## Exercices Session 1

### Exercice 01 — Hello and Loop

📁 [Exercices/01_hello_and_loop/Main.scala](Exercices/01_hello_and_loop/Main.scala)

**Consigne :** Déclarer une `val name: String`, afficher `Hello, <name>!` avec l'interpolation `s"..."`, puis afficher les nombres de 1 à 10 avec une boucle `for`.

```scala
object Main extends App {
  val name: String = "Antonin"

  println(s"Hello, $name!")

  for (i <- 1 to 10) println(i)
}
```

Rien de compliqué ici, mais quelques points à retenir :
- `val` et non `var` : le nom ne change jamais.
- `1 to 10` et pas `1 until 10`, sinon on s'arrête à 9.
- Dans ma première version j'avais écrit `s"Hello $name !"`, ce qui affiche `Hello Antonin !` au lieu de `Hello, Antonin!`. Ces exercices sont vérifiés automatiquement en comparant la sortie caractère par caractère : la virgule et l'espace comptent.

### Exercice 02 — Guess the Number (non-interactif)

📁 [Exercices/02_guess_the_number/Main.scala](Exercices/02_guess_the_number/Main.scala)

**Consigne :** Au lieu de jouer en direct, on rejoue une partie à partir d'une liste de tentatives déjà faites. Écrire :
```scala
def play(secret: Int, guesses: List[Int]): List[String]
```
Pour chaque tentative, produire `"Attempt N: X is too small!"`, `"Attempt N: X is too big!"` ou `"Attempt N: X is correct! Found in N attempt(s)."`. On s'arrête dès que le secret est trouvé et on ignore les tentatives suivantes.

#### Version impérative (ma première solution)

```scala
import scala.util.control.Breaks._

def play(secret: Int, guesses: List[Int]): List[String] = {
  var tries = 0
  var answers: List[String] = List()
  breakable {
    for (guess <- guesses) {
      tries = tries + 1
      if (guess == secret) {
        answers = answers :+ s"Attempt $tries: $guess is correct! Found in $tries attempt(s)."
        break()
      }
      else if (guess < secret) answers = answers :+ s"Attempt $tries: $guess is too small!"
      else answers = answers :+ s"Attempt $tries: $guess is too big!"
    }
  }
  answers
}
```

Ça marche, mais c'est exactement le style qu'on cherche à quitter : deux `var`, un `break` simulé par exception, et une liste qu'on reconstruit à chaque tour. En plus, `answers :+ x` (ajout **en fin** de `List`) coûte O(n) à chaque fois : on verra pourquoi en Session 2, et l'exercice 04 le mesure.

#### Version fonctionnelle

Décomposons le problème autrement : *quelles tentatives garde-t-on ?* Et *comment transforme-t-on chaque tentative en phrase ?*

```scala
def play(secret: Int, guesses: List[Int]): List[String] = {
  val (before, fromFound) = guesses.span(_ != secret)
  val relevant = before ++ fromFound.take(1)

  relevant.zipWithIndex.map { case (guess, index) =>
    val attempt = index + 1
    if (guess < secret) s"Attempt $attempt: $guess is too small!"
    else if (guess > secret) s"Attempt $attempt: $guess is too big!"
    else s"Attempt $attempt: $guess is correct! Found in $attempt attempt(s)."
  }
}
```

Étape par étape avec `secret = 42` et `guesses = List(50, 25, 40, 45, 42, 99)` :

1. **`span(p)`** coupe la liste en deux au premier élément qui ne vérifie plus `p`. Il renvoie un **tuple** (on verra les tuples en Session 2) :
   `before = List(50, 25, 40, 45)` et `fromFound = List(42, 99)`
2. **`fromFound.take(1)`** garde uniquement le bon nombre (`List(42)`), ou rien si le secret n'a jamais été trouvé (`take` sur une liste vide renvoie une liste vide, pas d'erreur).
   `relevant = List(50, 25, 40, 45, 42)`
3. **`zipWithIndex`** associe chaque élément à son indice (qui commence à 0) :
   `List((50,0), (25,1), (40,2), (45,3), (42,4))`
4. **`map { case (guess, index) => ... }`** transforme chaque paire en phrase. Le `case` permet de "déballer" le tuple directement en deux noms (c'est du pattern matching, qu'on verra en Session 5). Le `if/else if/else` est une expression : sa valeur est la phrase renvoyée.

Plus aucune `var`, plus de `break`, et chaque étape se teste indépendamment.

#### Bonus : version récursive

La `List` est faite pour la récursion (tête + reste, cf. Session 2). Une troisième façon de faire :
```scala
def play(secret: Int, guesses: List[Int], attempt: Int = 1): List[String] =
  if (guesses.isEmpty) Nil
  else {
    val guess = guesses.head
    if (guess == secret) List(s"Attempt $attempt: $guess is correct! Found in $attempt attempt(s).")
    else {
      val hint = if (guess < secret) "too small" else "too big"
      s"Attempt $attempt: $guess is $hint!" :: play(secret, guesses.tail, attempt + 1)
    }
  }
```
On traite la tête, et on laisse l'appel récursif s'occuper du reste. Le cas "trouvé" arrête naturellement la récursion (on ne se rappelle pas), ce qui remplace le `break`. `::` ajoute un élément en tête de liste (O(1)).

#### La version interactive des slides

Les slides décrivent en fait la version "live" : tirer un nombre au hasard et lire les propositions au clavier. Pour référence, en style fonctionnel (récursion au lieu d'une boucle `while` avec compteur) :
```scala
import scala.io.StdIn
import scala.util.Random

val secret = Random.nextInt(101) // entre 0 et 100 inclus

def loop(attempt: Int): Unit = {
  val guess = StdIn.readLine("Ton nombre : ").toInt
  if (guess < secret) { println("Trop petit !"); loop(attempt + 1) }
  else if (guess > secret) { println("Trop grand !"); loop(attempt + 1) }
  else println(s"Trouvé en $attempt essai(s) !")
}

loop(1)
```

---

# Session 2 — Collections

## Immuables par défaut

Quand on écrit `List`, `Vector`, `Map` ou `Set` sans import, on obtient la version **immuable** (du package `scala.collection.immutable`). Toute "modification" renvoie une **nouvelle** collection, l'originale n'est jamais touchée :
```scala
val a = List(1, 2, 3)
val b = 0 +: a
// a vaut toujours List(1, 2, 3)
// b vaut List(0, 1, 2, 3)
```
Des versions mutables existent dans `scala.collection.mutable` (`ArrayBuffer`, `mutable.Map`...), mais on ne les utilise que pour des besoins de performance bien identifiés.

On pourrait se dire que recréer une collection à chaque changement est un énorme gâchis de mémoire. En réalité non, grâce au **partage structurel** : la nouvelle collection réutilise la plus grande partie de l'ancienne. C'est possible *justement* parce que rien n'est mutable : si personne ne peut modifier `a`, `b` peut pointer dessus sans risque. Les sections suivantes montrent comment.

## List

**List :** Une **liste chaînée** immuable. Chaque élément (une "cellule") contient une valeur et un pointeur vers la cellule suivante. La dernière pointe vers `Nil`, la liste vide.

```scala
val nums = List(1, 2, 3)
// équivalent à :
val nums = 1 :: 2 :: 3 :: Nil
```

Schéma en mémoire :
```
nums ──► [1 | ●]──► [2 | ●]──► [3 | ●]──► Nil
```

Les deux opérations de base :
- **`head`** : le premier élément (`1`)
- **`tail`** : tout le reste, qui est lui-même une liste (`List(2, 3)`)

*Attention : `head` sur une liste vide lève une exception. `headOption` renvoie une `Option` à la place (on verra `Option` plus tard).*

### Pourquoi l'ajout en tête est rapide (O(1))

```scala
val more = 0 :: nums
```
```
more ──► [0 | ●]
               │
nums ────────► [1 | ●]──► [2 | ●]──► [3 | ●]──► Nil
```
On crée **une seule** nouvelle cellule qui pointe vers l'ancienne liste. Rien n'est copié, et `nums` n'a pas changé : les deux listes partagent `1, 2, 3`. Peu importe que la liste fasse 3 ou 3 millions d'éléments, le coût est le même : c'est du **temps constant, O(1)**.

### Pourquoi l'ajout en fin est lent (O(n))

```scala
val more = nums :+ 4
```
Pour ajouter `4` après `3`, il faudrait que la cellule `3` pointe vers `4` au lieu de `Nil`. Mais on n'a pas le droit de la modifier (elle est immuable, et `nums` l'utilise encore). La seule solution est de **recopier toute la liste** avec la nouvelle fin. Pour une liste de n éléments, on crée n+1 cellules : c'est **O(n)**.

Même logique pour l'accès par indice `nums(i)` : il faut suivre les pointeurs un par un depuis le début, donc O(i), O(n) dans le pire cas. Et `nums.length` aussi est en O(n) (il faut tout parcourir pour compter).

**À retenir :** avec une `List`, on construit **par la tête** et on parcourt **de la tête vers la queue**. Si on a besoin d'ajouter à la fin dans une boucle, on ajoute en tête puis on fait un `reverse` à la fin (une seule fois O(n) au lieu de n fois O(n)), ou mieux, on utilise un `Vector` ou une fonction comme `map`.

## Vector

**Vector :** Une collection **indexée** et immuable. En interne, c'est un **arbre** dont chaque nœud a jusqu'à 32 enfants, les éléments étant stockés dans les feuilles.

Pourquoi 32 ? Parce que la profondeur de l'arbre est de log₃₂(n) :
- 32 éléments → profondeur 1
- 1 024 éléments → profondeur 2
- 1 million d'éléments → profondeur 4
- 1 milliard d'éléments → profondeur 6

Pour accéder à un élément, on descend au maximum de 6 niveaux. Techniquement c'est du O(log n), mais en pratique c'est **"effectivement constant"**.

Pour "modifier" un élément ou ajouter en fin, on ne recopie que le **chemin** de la racine jusqu'à la feuille concernée (quelques nœuds de 32 cases), et tout le reste de l'arbre est partagé avec l'ancien `Vector`. Encore du partage structurel.

```scala
val v = Vector(1, 2, 3)
v(1)        // 2, accès rapide
v :+ 4      // Vector(1, 2, 3, 4), rapide
0 +: v      // Vector(0, 1, 2, 3), rapide aussi
v.updated(0, 99) // Vector(99, 2, 3)
```

## Performance List vs Vector

| Opération | List | Vector |
|---|---|---|
| Ajout en tête (`x +: xs`) | **O(1)** | O(log n) |
| Ajout en fin (`xs :+ x`) | O(n) | **O(log n)** |
| Accès aléatoire (`xs(i)`) | O(n) | **O(log n)** |
| Tête (`xs.head`) | **O(1)** | O(log n) |

**Règle générale :**
- **List** pour les algorithmes récursifs qui travaillent en "tête / reste" (`head` / `tail`), et quand on construit en ajoutant devant.
- **Vector** dès qu'on a besoin d'ajouter en fin ou d'accéder par indice. Dans le doute, `Vector` est un bon choix par défaut.

*Pour rappel sur la notation O : elle décrit comment le temps d'exécution évolue quand la taille n augmente. O(1) : ne dépend pas de n. O(n) : double si n double. O(log n) : augmente d'un cran à chaque fois que n est multiplié par une constante, ce qui reste minuscule même pour des n énormes.*

## Les opérateurs d'ajout

```scala
0 +: xs      // ajout en tête (marche sur toutes les séquences)
xs :+ 0      // ajout en fin
x :: list    // ajout en tête, spécifique à List
xs ++ ys     // concaténation de deux collections
```

**Moyen mnémotechnique :** les deux-points `:` sont toujours **du côté de la collection**. `+:` → la collection est à droite, on ajoute à gauche (devant). `:+` → la collection est à gauche, on ajoute à droite (derrière).

*Détail technique qui explique cette règle : en Scala, les opérateurs sont des méthodes (`a + b` est en fait `a.+(b)`). Et une méthode dont le nom finit par `:` est appelée **sur l'opérande de droite**. Donc `0 +: xs` est en réalité `xs.+:(0)`, et `1 :: 2 :: Nil` se lit `Nil.::(2).::(1)`, de droite à gauche.*

## Les tuples

**Tuple :** Un regroupement de quelques valeurs, potentiellement de types différents, sans avoir à créer de classe.
```scala
val person = ("Alice", 30)       // type : (String, Int)
person._1                        // "Alice"
person._2                        // 30

val (name, age) = person         // déstructuration, comme en Python
```
On accède aux éléments avec `._1`, `._2`... (attention, **ça commence à 1**, pas à 0).

C'est ce qui explique la syntaxe qu'on retrouve dans les exercices : **`sortBy(_._1)`** sert à trier une liste de tuples selon le premier élément de chaque tuple. Le premier `_` représente "chaque tuple" (voir les placeholders en Session 3), et `._1` prend son premier champ.

## Map

**Map[K, V] :** Une table **clé → valeur** (l'équivalent du dictionnaire Python). Chaque clé est unique.
```scala
val ages = Map("Alice" -> 30, "Bob" -> 25)
```
La flèche `->` n'est pas une syntaxe spéciale de `Map` : c'est juste une autre façon d'écrire un tuple. `"Alice" -> 30` est exactement `("Alice", 30)`. Une `Map` est donc construite à partir de paires.

Opérations courantes :
```scala
ages("Alice")               // 30
ages("Zoé")                 // EXCEPTION NoSuchElementException !
ages.get("Zoé")             // None (pas d'exception) — renvoie une Option
ages.get("Alice")           // Some(30)
ages.getOrElse("Zoé", 0)    // 0 (valeur par défaut)
ages.contains("Bob")        // true

ages + ("Charlie" -> 40)    // nouvelle Map avec Charlie en plus
ages - "Bob"                // nouvelle Map sans Bob
ages.keys                   // les clés
ages.values                 // les valeurs
ages.toList                 // List(("Alice", 30), ("Bob", 25))
```

**Option :** Un type qui représente "une valeur qui peut être absente". Soit `Some(valeur)`, soit `None`. C'est la manière Scala d'éviter les `null` et les exceptions surprises : le type lui-même nous oblige à gérer le cas "absent". On le reverra en détail.

**Attention à l'ordre :** Une `Map` ne garantit **aucun ordre** d'affichage ou de parcours. Si on veut un résultat prévisible, on la convertit en liste et on trie : `ages.toList.sortBy(_._1)`.

## Set

**Set[T] :** Une collection d'éléments **uniques**, sans ordre. Les doublons sont automatiquement éliminés.
```scala
val s = Set(1, 2, 2, 3, 3, 3)   // Set(1, 2, 3)
s.contains(2)                   // true, et c'est rapide
s(2)                            // true aussi (raccourci)
s + 4                           // Set(1, 2, 3, 4)
```
Son intérêt principal : le **test d'appartenance** est effectivement en temps constant (grâce à une table de hachage), alors que `list.contains(x)` doit parcourir toute la liste (O(n)).

---

## Exercices Session 2

### Exercice 03 — Word Counting

📁 [Exercices/03_word_counting/Main.scala](Exercices/03_word_counting/Main.scala)

**Consigne :** Écrire `def wordCount(words: List[String]): Map[String, Int]` qui associe chaque mot distinct à son nombre d'occurrences. Afficher ensuite une ligne `mot -> nombre` par mot, par ordre alphabétique.

```scala
object Main extends App {
  val words = List("A", "B", "A", "C", "B", "A")

  wordCount(words).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def wordCount(words: List[String]): Map[String, Int] =
    words.groupBy(identity).view.mapValues(_.size).toMap
}
```

Il y a beaucoup de choses dans ces quelques lignes, qu'on détaille en Session 3 (`groupBy`, `identity`, `mapValues`, placeholders `_`). Le déroulé :

1. **`words.groupBy(identity)`** regroupe les mots identiques :
   `Map("A" -> List("A", "A", "A"), "B" -> List("B", "B"), "C" -> List("C"))`
2. **`.view.mapValues(_.size)`** remplace chaque liste par sa taille : `A -> 3, B -> 2, C -> 1`
3. **`.toMap`** reconvertit la vue en vraie `Map`.

Pour l'affichage :
1. **`.toList`** transforme la `Map` en liste de tuples `(mot, nombre)`, parce qu'une `Map` n'a pas d'ordre garanti.
2. **`.sortBy(_._1)`** trie par le premier élément de chaque tuple (le mot).
3. **`.foreach { case (word, count) => ... }`** parcourt chaque tuple et le déballe en deux noms pour pouvoir les afficher. `foreach` est comme `map` mais pour les effets de bord : il ne renvoie rien (`Unit`).

### Exercice 04 — List vs Vector Benchmark

📁 [Exercices/04_list_vs_vector/Main.scala](Exercices/04_list_vs_vector/Main.scala)

**Consigne :** Écrire `def timeOperation(operation: => Unit): Long` qui exécute `operation` et renvoie sa durée en millisecondes. Créer une `List` et un `Vector` de 100 000 zéros, puis mesurer l'ajout en tête et l'ajout en fin sur chacun.

*(L'énoncé anglais dit 50 000, les slides disent 100 000 : ça ne change rien à la conclusion.)*

```scala
object Main extends App {
  val n = 100_000
  val list = List.fill(n)(0)
  val vector = Vector.fill(n)(0)

  val listPrepend = timeOperation(1 +: list)
  val vectorPrepend = timeOperation(1 +: vector)

  val listAppend = timeOperation(list :+ 1)
  val vectorAppend = timeOperation(vector :+ 1)

  println(s"Prepend : List = $listPrepend ms, Vector = $vectorPrepend ms")
  println(s"Append : List = $listAppend ms, Vector = $vectorAppend ms")

  def timeOperation(operation: => Unit): Long = {
    val start = System.nanoTime()
    operation
    val end = System.nanoTime()
    (end - start) / 1_000_000
  }
}
```

#### Le paramètre by-name `=> Unit`

C'est la vraie nouveauté de l'exercice. Normalement en Scala (comme en Python), les arguments sont évalués **avant** l'appel de la fonction :
```scala
def timeOperation(operation: Unit): Long = ...
timeOperation(list :+ 1)
```
Ici, `list :+ 1` serait calculé **d'abord**, puis son résultat serait passé à `timeOperation`. Quand le chronomètre démarre, le travail est déjà fait : on mesurerait toujours ~0 ms.

Avec **`operation: => Unit`** (noter la flèche), le paramètre est **by-name** : l'expression est passée *non évaluée*, et elle n'est exécutée qu'au moment où on écrit `operation` dans le corps de la fonction. Donc entre `start` et `end`. C'est exactement ce qu'il faut pour un chronomètre.

*Si on écrit `operation` deux fois dans le corps, l'expression est exécutée deux fois. C'est différent d'une valeur calculée une fois pour toutes.*

*Autre détail : `1 +: list` renvoie une `List[Int]`, pas un `Unit`. Le compilateur accepte quand même parce qu'il fait du "value discarding" : quand on attend `Unit`, il calcule la valeur puis la jette.*

#### Pourquoi `nanoTime` plutôt que `currentTimeMillis`

Ma première version utilisait `System.currentTimeMillis()`. Ça marche, mais :
- `currentTimeMillis` donne l'heure "murale", qui peut être ajustée par le système (synchronisation NTP) pendant la mesure.
- Sa précision réelle peut être de l'ordre de 10 ms sur certains OS, alors que les opérations mesurées sont souvent plus rapides que ça.

`System.nanoTime()` est fait exactement pour mesurer des durées : monotone et bien plus précis. On divise par 1 000 000 pour repasser en millisecondes comme demandé.

#### Ce qu'on observe

Les chiffres exacts varient d'une machine à l'autre, mais le résultat attendu est toujours le même : **l'ajout en fin sur la `List` est le seul qui prend du temps** (il recopie les 100 000 cellules), les trois autres sont à 0 ms ou presque.

*Un micro-benchmark comme celui-ci est approximatif : la JVM compile et optimise le code au fur et à mesure (JIT), donc le premier appel est souvent plus lent que les suivants. Pour des mesures sérieuses on utilise un outil dédié comme JMH, qui répète les mesures après une phase de "chauffe". Ici, l'ordre de grandeur suffit.*

C'est aussi ce qui explique pourquoi ma version impérative de l'exercice 02 (`answers = answers :+ ...` dans une boucle) était une mauvaise idée : n ajouts en fin de `List`, chacun en O(n), ça donne du O(n²).

---

# Session 3 — Pipelines fonctionnels

## Les fonctions sont des valeurs

En Scala (comme en Python, mais de façon plus centrale), une fonction est une **valeur** comme une autre : on peut la stocker dans une `val`, la passer en argument, la renvoyer.

**Fonction anonyme (lambda) :**
```scala
val double = (x: Int) => x * 2
double(5)   // 10
```
Syntaxe : `(paramètres) => corps`. C'est l'équivalent du `lambda x: x * 2` de Python.

Le type de `double` est `Int => Int` : "une fonction qui prend un `Int` et renvoie un `Int`".

Quand le type du paramètre peut être deviné grâce au contexte, on peut l'omettre :
```scala
List(1, 2, 3).map(x => x * 2)   // Scala sait que x est un Int, puisque c'est une List[Int]
```

### La syntaxe placeholder `_`

Quand chaque paramètre n'est utilisé **qu'une seule fois**, et dans l'ordre, on peut remplacer `x => ...x...` par `_` :
```scala
list.map(x => x * 2)          // version explicite
list.map(_ * 2)               // version placeholder, identique

list.filter(x => x % 2 == 0)
list.filter(_ % 2 == 0)

list.reduce((a, b) => a + b)
list.reduce(_ + _)            // chaque _ est un paramètre DIFFÉRENT : le 1er puis le 2e

tuples.sortBy(t => t._1)
tuples.sortBy(_._1)
```

**Les pièges :**
- Chaque `_` est un **nouveau** paramètre. `_ * _` veut dire `(a, b) => a * b`, pas `x => x * x`. Pour mettre au carré, il faut écrire `x => x * x`.
- Le `_` "s'arrête" à l'expression la plus proche. `list.map(f(g(_)))` ne veut pas dire `x => f(g(x))` mais `f(x => g(x))`. Dès que ça s'imbrique, on repasse à la syntaxe explicite.

Règle pratique : **`_` pour les cas simples et évidents, `x => ...` dès qu'il y a le moindre doute.**

## Fonctions d'ordre supérieur

**Fonction d'ordre supérieur (higher-order function) :** Une fonction qui prend une autre fonction en paramètre (ou qui en renvoie une). `map`, `filter`, `reduce` en sont les exemples les plus connus : on leur donne le *quoi faire*, elles s'occupent du *comment parcourir*.

C'est ce qui remplace les boucles en programmation fonctionnelle.

### Le trio fondamental

**`filter(p)` :** Garde uniquement les éléments pour lesquels le **prédicat** `p` renvoie `true`. (Un prédicat est une fonction qui renvoie un `Boolean`.) La taille du résultat est inférieure ou égale à l'originale.
```scala
List(1, 2, 3, 4, 5, 6).filter(_ % 2 == 0)   // List(2, 4, 6)
```
Son inverse existe : `filterNot`.

**`map(f)` :** Applique la fonction `f` à **chaque** élément et renvoie une collection de **même taille** avec les résultats. Le type des éléments peut changer.
```scala
List(1, 2, 3).map(_ * 3)          // List(3, 6, 9)
List("a", "bb").map(_.length)     // List(1, 2)       List[String] → List[Int]
```

**`reduce(f)` :** **Agrège** tous les éléments en une seule valeur, en les combinant deux par deux avec `f`.
```scala
List(1, 2, 3, 4).reduce(_ + _)
// ((1 + 2) + 3) + 4 = 10
```
Problème : sur une liste **vide**, `reduce` lève une exception (il n'y a rien à combiner, et pas de valeur de départ).

**`fold` / `foldLeft` :** Comme `reduce`, mais avec une **valeur initiale**. Plus sûr, et plus flexible :
```scala
List(1, 2, 3, 4).foldLeft(0)(_ + _)      // 0 + 1 + 2 + 3 + 4 = 10
List[Int]().foldLeft(0)(_ + _)           // 0, pas d'exception
```
La valeur initiale (l'**accumulateur**) peut être d'un type différent des éléments, ce qui rend `foldLeft` capable de presque tout :
```scala
List("a", "bb", "ccc").foldLeft(0)((acc, word) => acc + word.length)   // 6
```
On peut le voir comme la version fonctionnelle de ce motif impératif :
```scala
var acc = 0                 // valeur initiale
for (x <- list) acc = f(acc, x)
```

Pour les cas courants, Scala fournit des raccourcis déjà écrits avec `fold` : `sum`, `product`, `max`, `min`, `count(p)`, `exists(p)`, `forall(p)`...

### Chaîner les opérations : les pipelines

Comme chaque opération renvoie une nouvelle collection, on peut enchaîner les appels. On obtient un **pipeline** déclaratif qui se lit de gauche à droite comme une recette :
```scala
list.filter(_ % 2 == 0).map(_ * 3).sum
```
*Garde les pairs → multiplie par 3 → fais la somme.*

Quand la chaîne devient longue, on l'écrit sur plusieurs lignes, un point par ligne :
```scala
list
  .filter(_ % 2 == 0)
  .map(_ * 3)
  .sum
```

C'est exactement le modèle de Spark : les données passent dans une série de transformations, chacune pure et indépendante. Sauf que Spark répartit chaque étape sur plusieurs machines.

*Chaque étape d'une chaîne crée une collection intermédiaire complète. Pour de très grosses collections, on peut ajouter `.view` au début : les opérations deviennent alors **paresseuses** (lazy), elles sont combinées et appliquées élément par élément seulement quand on demande le résultat final, sans collection intermédiaire.*

## groupBy

**`groupBy(f)` :** Regroupe les éléments d'une collection selon une **fonction clé** `f`, et renvoie une `Map` : pour chaque valeur de clé, la liste des éléments qui l'ont produite.
```scala
val words = List("apple", "avocado", "banana", "blueberry", "cherry")
words.groupBy(_.head)
// Map('a' -> List("apple", "avocado"),
//     'b' -> List("banana", "blueberry"),
//     'c' -> List("cherry"))

List(1, 2, 3, 4, 5).groupBy(_ % 2 == 0)
// Map(false -> List(1, 3, 5), true -> List(2, 4))
```

Pour **compter** des éléments identiques, on veut que la clé soit l'élément lui-même. On pourrait écrire `groupBy(x => x)`, mais Scala fournit une fonction toute faite pour ça : **`identity`**, la fonction qui renvoie son argument sans le modifier.
```scala
List("A", "B", "A").groupBy(identity)
// Map("A" -> List("A", "A"), "B" -> List("B"))
```

### mapValues et le piège de la dépréciation

Les slides donnent :
```scala
words.groupBy(identity).mapValues(_.length)
```
**`mapValues(f)`** applique `f` aux **valeurs** d'une `Map` en gardant les clés. Ici on remplace chaque groupe par sa taille.

Problème : depuis Scala 2.13, `mapValues` directement sur une `Map` est **déprécié** (le compilateur affiche un warning). La raison : il ne renvoyait pas une vraie nouvelle `Map`, mais une *vue* paresseuse qui recalculait `f` à **chaque accès**, ce qui surprenait tout le monde (effets de bord répétés, performances imprévisibles). La version correcte aujourd'hui est de rendre la vue explicite, puis de la matérialiser :
```scala
words.groupBy(identity).view.mapValues(_.size).toMap
```

Alternatives équivalentes, sans vue :
```scala
words.groupBy(identity).map { case (word, group) => (word, group.size) }

// Scala 2.13+ : groupBy + map + reduce en une seule passe, sans créer les listes intermédiaires
words.groupMapReduce(identity)(_ => 1)(_ + _)
```
`groupMapReduce(clé)(valeur)(combinaison)` : regroupe par `identity`, transforme chaque élément en `1`, puis additionne les `1` de chaque groupe. C'est la version la plus efficace, et très proche de ce qu'on fera en Spark (`reduceByKey`).

*`size` et `length` sont équivalents sur les séquences. `length` est spécifique aux séquences, `size` marche sur toutes les collections (y compris `Set` et `Map`).*

## case class

Une **case class** est une classe pensée pour être un **conteneur de données immuable**. On la déclare en une ligne :
```scala
case class Record(name: String, value: Int)
```

Et en échange, le compilateur génère automatiquement tout un tas de choses qu'on devrait écrire à la main (en Java, ça ferait facilement 50 lignes) :
- **Pas besoin de `new`** : `Record("a", 1)` (grâce à une méthode `apply` générée)
- **Champs publics et immuables** : `r.name`, `r.value` (ce sont des `val`)
- **`toString`** lisible : `Record(a,1)` au lieu de `Record@6d06d69c`
- **`equals` et `hashCode`** basés sur le **contenu** : deux `Record` avec les mêmes valeurs sont égaux
- **`copy`** pour créer une version modifiée sans toucher l'original
- Le support du **pattern matching** (Session 5)

```scala
val r1 = Record("temp", 20)
val r2 = Record("temp", 20)

r1 == r2              // true  (avec une classe normale : false, car ce sont 2 objets différents)
println(r1)           // Record(temp,20)

val r3 = r1.copy(value = 25)   // Record(temp,25), r1 est inchangé
r1.value = 30         // ERREUR : les champs sont des val
```

**Pourquoi `equals`/`hashCode` sont importants :** Par défaut, deux objets sont "égaux" seulement s'ils sont *le même objet en mémoire*. Avec une case class, l'égalité se fait par valeur. Ça permet de les mettre dans un `Set`, de les utiliser comme clés de `Map`, de les comparer dans des tests, ou de s'en servir comme clé de `groupBy`. `hashCode` doit toujours être cohérent avec `equals` (deux objets égaux doivent avoir le même hash), et la case class s'en occupe.

**`copy` et l'immuabilité :** C'est la façon fonctionnelle de "modifier" un objet : on n'altère pas l'existant, on crée une nouvelle version avec un ou plusieurs champs différents. Les champs non mentionnés sont repris tels quels.

Les case class se combinent parfaitement avec les pipelines :
```scala
val records = List(Record("a", 10), Record("b", 5), Record("a", 3))

records.filter(_.value > 4).map(_.name)          // List("a", "b")
records.groupBy(_.name).view.mapValues(_.map(_.value).sum).toMap
// Map("a" -> 13, "b" -> 5)
```
C'est l'équivalent d'une ligne de table en base de données : en Spark, on décrit le schéma d'un `Dataset` avec une case class.

---

## Exercices Session 3

### Exercice 05 — Functional Pipeline: Numbers

📁 [Exercices/05_pipeline_numbers/Main.scala](Exercices/05_pipeline_numbers/Main.scala)

**Consigne :** Écrire `def processNumbers(nums: List[Int]): Int` qui garde les nombres pairs, les multiplie par 3, et renvoie la somme. Avec `List(1, 2, 3, 4, 5, 6)`, on attend `36` (2×3 + 4×3 + 6×3 = 6 + 12 + 18).

```scala
object Main extends App {
  val nums = List(1, 2, 3, 4, 5, 6)
  println(processNumbers(nums))

  def processNumbers(nums: List[Int]): Int =
    nums.filter(_ % 2 == 0).map(_ * 3).sum
}
```

C'est le pipeline de cours, mot pour mot :
1. `filter(_ % 2 == 0)` → `List(2, 4, 6)`
2. `map(_ * 3)` → `List(6, 12, 18)`
3. `sum` → `36`

On aurait pu écrire `.map(x => x * 3)` (c'était ma première version), c'est strictement équivalent. On aurait aussi pu remplacer `sum` par `foldLeft(0)(_ + _)` ou `reduce(_ + _)`, mais `reduce` planterait sur une liste sans aucun nombre pair, alors que `sum` renvoie `0`.

Pour comparer, la version impérative :
```scala
var total = 0
for (n <- nums) if (n % 2 == 0) total += n * 3
```

### Exercice 06 — Functional Pipeline: Text

📁 [Exercices/06_pipeline_text/Main.scala](Exercices/06_pipeline_text/Main.scala)

**Consigne :** Écrire `def textPipeline(text: String): Map[String, Int]` qui découpe le texte en mots (sur les espaces), met chaque mot en minuscules, garde les mots d'au moins 4 caractères, et compte les occurrences. Afficher le résultat par ordre alphabétique.

```scala
object Main extends App {
  val text = "Scala is great and Scala is functional"

  textPipeline(text).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def textPipeline(text: String): Map[String, Int] =
    text
      .split("\\s+")
      .map(_.toLowerCase)
      .filter(_.length >= 4)
      .groupBy(identity)
      .view.mapValues(_.length)
      .toMap
}
```
Sortie attendue :
```
functional -> 1
great -> 1
scala -> 2
```

Le déroulé avec `"Scala is great and Scala is functional"` :
1. `split("\\s+")` → `Array("Scala", "is", "great", "and", "Scala", "is", "functional")`
2. `map(_.toLowerCase)` → `Array("scala", "is", "great", "and", "scala", "is", "functional")`
3. `filter(_.length >= 4)` → `Array("scala", "great", "scala", "functional")`
4. `groupBy(identity)` → `Map("scala" -> Array("scala", "scala"), "great" -> ..., "functional" -> ...)`
5. `view.mapValues(_.length).toMap` → `Map("scala" -> 2, "great" -> 1, "functional" -> 1)`

La seconde moitié du pipeline est exactement l'exercice 03 : on a juste ajouté une préparation du texte avant.

Quelques différences avec ma première version (`text.toLowerCase().split(" ").filter(s => s.length > 3)...`), qui donnait le bon résultat sur l'exemple :
- **`split("\\s+")` au lieu de `split(" ")` :** l'énoncé dit "sur les espaces blancs" (*whitespace*). `split` prend une **expression régulière** : `\s` désigne n'importe quel caractère blanc (espace, tabulation, retour à la ligne) et `+` veut dire "un ou plusieurs". Avec `split(" ")`, deux espaces consécutifs produiraient un mot vide `""`, et une tabulation ne séparerait rien. (Le `\` est doublé parce qu'il faut l'échapper dans une chaîne Scala.)
- **`_.length >= 4` au lieu de `s.length > 3` :** c'est équivalent pour des entiers, mais recopier la condition de l'énoncé telle quelle ("longueur ≥ 4") rend le code plus facile à relire.
- **Minuscules avant ou après le split :** les deux marchent. Le faire mot par mot suit l'ordre de la consigne, le faire sur tout le texte d'un coup est un poil plus efficace. Aucune importance ici.
- `split` renvoie un `Array` (le tableau Java), pas une `List`. Toutes les méthodes de collection (`map`, `filter`, `groupBy`...) marchent quand même dessus.

---

# Récap des Sessions 1 à 3

- **Préférer `val` à `var`**, et les collections immuables (celles par défaut).
- **Tout est expression** : `if/else`, les blocs, les fonctions renvoient leur dernière valeur, pas de `return`.
- **`for ... yield`** construit une collection, `for` sans `yield` ne sert qu'aux effets de bord.
- **List** = liste chaînée : rapide en tête, lente en fin et en accès indexé. **Vector** = arbre à 32 branches : rapide partout.
- Les collections immuables ne recopient pas tout grâce au **partage structurel**.
- **Tuples** : `(a, b)`, `._1`, `._2`. `a -> b` est un tuple. `sortBy(_._1)` trie par le premier élément.
- **Map** : `get` renvoie une `Option`, pas d'ordre garanti.
- Les **fonctions sont des valeurs**, `_` est un raccourci pour les lambdas simples.
- **filter / map / reduce / foldLeft** remplacent les boucles, et se chaînent en **pipelines**.
- **`groupBy(identity).view.mapValues(_.size).toMap`** pour compter (ou `groupMapReduce`).
- **case class** = conteneur de données immuable avec `equals`, `toString`, `copy` gratuits.
