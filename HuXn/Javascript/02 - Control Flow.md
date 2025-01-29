# Conditions

Une alternative (peu utilisé) à la boucle `while` est la boucle `do while`

```javascript
do{
    ...
} while (condition);
```

On peut concaténer deux tableaux pour obtenir un nouveau tableau grâce à `.concat`. Si on utilise `+` on obtient une chaîne de caractères.

On peut supprimer une clé et sa valeur d'un objet en utilisant `delete`

```js
delete person.firstName;
```

# Function declaration / expression

```javascript
// Declaration
function sayHello(name) {
  console.log(`Hello ${name}`);
}

sayHello("Michel");

// Expression
const greetings = function (user) {
  console.log(`Hello ${user}`);
};

greetings("John");
```

Ces deux Syntaxes fonctionnent, mais la fonction déclarée pourra être appelée avant d'être déclarée, alors que la fonction stockée dans une variable non.

# Callback Functions

Une fonction qui est passée en argument d'une autre fonction.

Elle peut être anonyme en utilisant une fonction fléchée. Un exemple courant est de créer une action asynchrone en utilisant une fonction de délai :

```js
setTimeout(() => {
  console.log("Cette fonction fléchée s'exécute après 2 secondes !");
}, 2000);
```

Pourquoi utiliser les callbacks ?

- **Exécution différée** : attendre qu’un événement se produise (ex. clic, chargement d’une ressource).
- **Éviter le blocage** : utile en programmation asynchrone (ex. appels API).
- **Réutilisation du code** : permet de créer des fonctions plus flexibles.

# JSON

`JSON.stringity(objet)` transforme l'objet en chaîne de caractères JSON

`JSON.parse(json)` transforme le JSON en objet

# setInterval()

`setInterval(function, x)` permet d'exécuter une fonction toutes les `x` millisecondes

# setTimeout

`setTimeout(function, x)` permet d'exécuter une fonction après `x` millisecondes

# clearInterval

`clearInterval` permet d'arrêter un `setInterval`.

Combiné à un `setTimeout`, cela permet d'exécuter une fonction régulièrement, pendant un temps donné.

```js
let intervalId = setInterval(() => {
  console.log("Ce message s'affiche chaque seconde");
}, 1000);

setTimeout(() => {
  clearInterval(intervalId);
  console.log("Cela fait 10 secondes, j'arrête d'afficher des messages");
}, 10000);
```

# Fonction fléchées

Une syntaxe très réduite pour déclarer une fonction, très pratique pour les fonctions simples

```js
// Syntaxe classique
function double(n) {
  return n * 2;
}

// Syntaxe fléchée
const double = (n) => n * 2;

// Même appel pour les deux fonctions
double(10);
```

# Enhanced Object Literals

## Raccourci pour les propriétés (Property Shorthand)

Si les **variables et les clés ont le même nom**, on peut utiliser cette syntaxe beaucoup plus compacte.

```js
const nom = "Alice";
const age = 25;

// Syntaxe historique
const personne = {
  nom: nom,
  age: age,
};

// Syntaxe moderne
const personne = { nom, age };
```

## Raccourci pour les Méthodes (Method Shorthand)

```js
// Syntaxe historique
const objet = {
  salut: function () {
    return "Bonjour !";
  },
};

// Syntaxe moderne

const objet = {
  salut() {
    return "Bonjour !";
  },
};
```

## Computed Property Names (Clés dynamiques)

```js
// Syntaxe historique
const cle = "nom";
const personne = {};
personne[cle] = "Alice";

// Syntaxe moderne
const cle = "nom";
const personne = {
  [cle]: "Alice",
};
```

## Object.assign() remplacé par le Spread Operator "..."

```js
const obj1 = { a: 1, b: 2 };
const obj2 = { c: 3 };

// Syntaxe historique
const fusion = Object.assign({}, obj1, obj2);

// Syntaxe moderne
const fusion = { ...obj1, ...obj2 };

console.log(fusion); // { a: 1, b: 2, c: 3 }
```

# Valeurs par défaut pour les arguments d'une fonction

Si on veut assigner une valeur par défaut à une fonction pour laquelle on aurait omis un argument, on peut utiliser la syntaxe suivante

```js
function functionName(arg = "value")
```
