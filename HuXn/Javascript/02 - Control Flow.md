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

# Spread Operators

Un spread operator prend un objet itérable (tableau, chaîne de caractères), et le divise en ses éléments individuels.

Il s'agit d'une copie **superficielle** (contrairement aux copies profondes), ce sont les références des objets qui sont copiés, donc modifier la copie modifiera aussi l'original.

## Pour des fonctions

Si on a une fonction qui prend n arguments en entrée, et qu'on veut lui passer un tableau de taille n, le premier argument sera le tableau et les autres arguments seront undefined.

Pour pouvoir passer chaque élément du tableau à chaque argument, on utilise à nouveau le spread operator `...`

```js
let args = ["value1", "value2", "value3"];

function functionName(a, b, c){
  ...
}

// a = args
functionName(args);

// a = value1, b = value2, c = value3
functionName(...args)
```

## Pour des tableaux

On peut facilement concaténer des tableaux comme ceci

```js
let tableau1 = [1, 2, 3];
let tableau2 = [4, 5, 6];

/// [0, [1, 2, 3], [4, 5, 6], 7, 8, 9]
let nouvTableau = [0, tableau1, tableau2, 7, 8, 9];

/// [0, 1, 2, 3, 4, 5, 6, 7, 8 ,9]
let concat = [0, ...tableau1, ...tableau2, 7, 8, 9];
```

## Pour des objets

```js
let obj1 = { a: 1, b: 2 };
let obj2 = { c: 3 };

/// {obj1 : {a:1, b:2}, obj2 : {c:3}}
let obj3 = { obj1, obj2 };

/// {a:1, b:2, c:3}
let obj4 = { ...obj1, ...obj2 };
```

## Rest Parameter

Le spread operateur peut être utilisé sur le dernier argument d'une fonction pour indiquer que cette fonction acceptera un nombre indéterminé d'arguments. Tous les arguments passés à la fonction qui viendront après la liste d'arguments définie seront passés au dernier argument sous forme d'un tableau.

```js

// Cette fonction peut accueillir un prénom, un nom, et un nombre indéfini de hobbies
function person(firstName, lastName, ...hobbies) {
  ...
}
```

## Déstructuration d'un tableau ou d'un objet

Permet d'extraire les valeurs d'un tableau ou d'un objet afin de travailler sur ces données.

```js
const personne = {
  nom: "Alice",
  age: 25,
  ville: "Paris",
};

// Extraction rapide des valeurs
const { nom, age, ville } = personne;

// Equivalent à :
const nom = personne.nom;
const age = personne.age;
const ville = personne.ville;

// Alice 25 Paris
console.log(nom, age, ville);
```

On peut utiliser le spread operator pour stocker le reste des valeurs dans un nouveau tableau ou objet, tronqué des valeurs qu'on a déjà récupéré.

```js
const { nom, ...autre } = personne;

// [25, "Paris"]
console.log(autre);
```

Pour les tableaux, c'est l'ordre des constantes qui est important. Pour les objets, c'est leur nom qui doit correspondre aux clés de l'objet.

Si on souhaite donner des noms différents de nos clés à nos variables, on peut le faire en utilisant cette syntaxe :

```js
const { nom: prénom, age: vieillesse, ville: lieu } = personne;

// Alice 25 Paris
console.log(prénom, vieillesse, lieu);
```

### Pour passer un objet dans une fonction

```js
const personne = {
  nom: "Alice",
  age: 25,
  ville: "Paris",
};

// Methode classique
function afficherInfos(person) {
  console.log(`Name : ${person.nom}`);
  console.log(`Age : ${person.age}`);
  console.log(`Ville : ${person.ville}`)
}

// Meilleure méthode

function afficherMieux({nom, age, ville}){
  console.log(`Name : ${nom}`);
  ...
}

afficherMieux(personne);
```

En gros, on destructure notre objet dans la définition de ses arguments plutôt que dans la définition de ce qu'elle fait, ce qui permet de gagner du temps (même si pour un exemple simple comme celui ci, ce n'est pas forcément un gain énorme)

### Un exemple un peu plus complexe

Voilà un exemple pour destructurer un objet un peu plus complexe en tant qu'argument d'une fonction

```js
let options = {
  title: "My Menu",
  items: ["item1", "item2"],
};

function showMenu({
  title,
  // On renomme width en w et height en h, et on leur donne des valeurs par défaut
  width: w = 200,
  height: h = 100,
  items: [item1, item2],
}) {
  console.log(`${title} ${w} ${h}`);
  console.log(`${item1}`);
  console.log(`${item2}`);
}
```

## Déstrustructuration d'un objet imbriqué (nested)

Partons d'un objet complexe :

```js
const data = {
  user: {
    id: 123,
    name: "John Doe",
    age: 30,
    email: "john.doe@example.com",
    address: {
      city: "New York",
      country: "USA",
    },
    hobbies: ["Reading", "Painting", "Cooking"],
    scores: {
      math: 95,
      science: 88,
      history: 75,
    },
  },
  products: [
    { id: 1, name: "Laptop", price: 1000 },
    { id: 2, name: "Phone", price: 800 },
    { id: 3, name: "Tablet", price: 500 },
  ],
  settings: {
    darkMode: true,
    notifications: {
      email: true,
      sms: false,
      push: true,
    },
    language: "English",
  },
};
```

Etant donné qu'on travaille avec un objet, accéder au données n'est pas très compliqué, car il suffit de fournir les bons noms des clés.

C'est juste massif, car il y a beaucoup de données à extraire.

```js
const {
  user: {
    name,
    age,
    address: { city, country },
    hobbies,
    scores: { math, science, history },
    email,
  },
  products: [product1, product2, product3],
  settings: {
    darkMode,
    notifications: {
      email: emailNotifications,
      sms: smsNotifications,
      push: pushNotifications,
    },
    language,
  },
} = data;
```

En gros ici on crée une constante par clé, on lui donne le même nom que la clé, ou on le renomme (Ex : `email: emailNotifications`) et on lui attribue la valeur de notre objet.

On peut ensuite accéder aux données simplement, en appelant la bonne clé.

Dans cette version une exception est pour les produits, pour lesquels on a choisi de garder leur structure d'objet. Pour accéder à leurs valeurs, on utilise la syntaxe classique d'accès à une clé d'objet.

```js
console.log(`Name: ${name}`);
console.log(`Product 1: ${product1.name} - $${product1.price}`);
console.log(`Email Notifications: ${emailNotifications}`);
```

# Opérateur ternaire (condition ? ifTrue : ifFalse;)

On connait déjà, syntaxe symplifiée pour un if statement binaire.

```js
function estMajeur(age) {
  return age >= 18
    ? "Cette personne est majeure"
    : "Cette personne est mineure";
}

// Cette personne est majeure
console.log(estMajeur(25));
// Cette personne est mineure
console.log(estMajeur(12));
```

# Itérer sur une structure

## Boucle for in

On connait déjà, permet d'itérer sur `les indexs d'un tableau` ou `les clés d'un objet` qui a un nombre indéfini de valeurs auxquelles on veut accéder.

```js
const person = {
  name: "Alice",
  age: 25,
  city: "Paris",
};

for (let keys in person) {
  console.log(person[keys]);
}
```

## Boucle for of

Permet d'itérer directement sur `les valeurs d'un tableau ou d'un objet`.

```js
const person = {
  name: "Alice",
  age: 25,
  city: "Paris",
};

for (let values of person) {
  console.log(values);
}
```

## Méthode forEach()

Permet d'itérer sur un tableau grâce à une callback function

```js
const person = ["Alice", 25, "Paris"];

person.forEach((value) => console.log(value));
```

Ici, on se contente d'afficher toutes les valeurs contenues dans le tableau, mais bien sûr on peut créer des callback functions plus complexes, qui auront un effet sur les valeurs du tableau.

Par exemple, si on souhaite faire la somme d'un tableau de valeurs numériques :

```js
const num = [12, 17, 16, 11, 5, 10];

// Syntaxe avec une fonction classique
function adder(numArray) {
  let sum = 0;
  for (let i = 0; i < numArray.length; i++) {
    sum += numArray[i];
  }
  return sum;
}
console.log(adder(num));

// Syntaxe avec forEach
let sum = 0;
num.forEach((number) => (sum += number));
console.log(sum);
```

On peut aussi définir la fonction de callback en dehors de notre `forEach`, ce qui peut être intéressant si la fonction est complexe.
Ici ça donnerait :

```js
const num = [12, 17, 16, 11, 5, 10];
let sum = 0;
function add(number) {
  sum += number;
}
num.forEach(add);
console.log(sum);
```

## Méthode map()

Cette méthode crée un nouveau tableau avec les résultats de la fonction de callback appliquée à chaque élément de l'objet itérable d'origine.

```js
const num = [12, 17, 16, 11, 5, 10];

double = num.map((number) => number * 2);
// [24, 34, 32, 22, 10, 20]
console.log(double);
```

## Méthode find()

Cette méthode permet de trouver le premier élément qui remplit une certaine condition.

Cette méthode retourne `undefined` si aucun élément ne remplit la condition.

```js
const peoples = [
  { name: "huxn", age: 17 },
  { name: "john", age: 18 },
  { name: "alex", age: 20 },
  { name: "jimmy", age: 30 },
  { name: "alex", age: 30 },
];

// { name: "alex", age: 20 }
console.log(peoples.find((person) => person.name === "alex"));
```

## Méthode filter()

Cette méthode crée un nouveau tableau avec tous les éléments de l'objet d'origine qui remplissent une certaine condition.

```js
const songs = [
  { name: "Lucky You", duration: 4.34 },
  { name: "Just Like You", duration: 3.23 },
  { name: "The Search", duration: 2.33 },
  { name: "Old Town Road", duration: 1.43 },
  { name: "The Box", duration: 5.23 },
];

// Crée un tableau d'objets sur la base de notre tableau d'origine
//dont la durée est supérieure à 3
console.log(songs.filter((song) => song.duration > 3));
```

## Méthodes every() & some()

Ces méthodes retournent un booléen, `true` si tous les éléments remplissent la condition de la callback function dans le cas de `every()`, ou si au moins un élément remplit la condition dans le cas de `some()`, false dans le cas contraire.

```js
let products = [
  { name: "Checkers", category: "Toys" },
  { name: "Harry Potter", category: "Books" },
  { name: "iPhone", category: "Electronics" },
  { name: "Learn PHP", category: "Books" },
];

// False
console.log(products.every((product) => product.category === "Books"));
// True
console.log(products.some((product) => product.category === "Books"));
```

## Méthode reduce()

Cette méthode est une méthode d'agrégation, c'est à dire qu'elle prend une liste de valeurs en arguments et ne retourne qu'une seule valeur.

Sa syntaxe se présente comme ça :

`obj.reduce((accumulateur, valeur) => operations, valeurInitiale)`

Par convention, on nomme l'accumulateur `acc` et la valeur actuelle `val`, mais on pourrait leur donner n'importe quel nom.
Par exemple, pour faire la somme des valeurs d'un tableau :

```js
const num = [1, 2, 3, 4, 5];

// 15
console.log(num.reduce((acc, val) => acc + val, 0));
```

Ou pour trouver l'âge de la personne la plus agée dans une liste d'objets :

```js
const ageMax = personnes.reduce(
  (maxAge, personne) => (personne.age > maxAge ? personne.age : maxAge),
  0
);
```

# Map

Une `map` est une structure de données relativement similaire aux objets, avec une différence clé : Les clés d'un objet sont forcément des strings, mais les clés d'une `map` peuvent être de tous les types (numériques, booléens, objets, fonctions... même d'autres maps !)

Les `maps` conservent l'ordre d'insertion des éléments, ce qui n'est pas forcément le cas des objets.

Cela permet d'itérer facilement sur ses élements, grâce à des méthodes préconstruites.

```js
const map = new Map();
```

## Insérer des éléments dans une map

```js
map.set("key", "value");

// {"key" => "value"}
console.log(map);
```

## Accéder aux données d'une map

```js
// {"key"}
console.log(map.keys());

// {"value"}
console.log(map.values());

// Récupérer la valeur d'une clé spécifique
map.get("key");
```

## Supprimer des éléments d'une map

```js
// On précise le nom de la clé à supprimer
map.delete("key");

// {}
console.log(map);
```

## map.size

Retourne la taille de la map

## Itérer sur une map

On peut utiliser les syntaxes précédentes pour itérer facilement dans une map

```js
// Pour récupérer les paires
for (let [key, value] of map) {
  console.log(`${key} : ${value}`);
}

// Pour récupérer les clés
for (let key of map.keys) {
  console.log(key);
}

// Pour récupérer les valeurs
for (let value of map.values) {
  console.log(value);
}
```

# Set

Un set est une structure de données similaire, sauf que les éléments doivent être uniques, les doublons sont automatiquement supprimés.

Cette structure est pratique lorsque l'on doit vérifier efficacement qu'une valeur existe.

```js
const values = [1, 2, 2, 3];
const set = new Set(values);

// {1, 2, 3}
console.log(set);
```

## Ajouter une valeur à un set

```js
set.add("value");
```

## Vérifier si un set contient

```js
// Retourne un booléen
set.has("value");
```

## Supprimer une valeur dans un set

```js
set.delete("value");
```

## Vider un set

```js
set.clear();
```

# Symbols

Un Symbol est un type de donnée primitif et unique utilisé principalement pour créer des clés d'objet non conflictuelles. Contrairement aux chaînes de caractères (string), chaque Symbol est toujours unique, même si deux Symbols portent le même nom. Cela le rend utile pour éviter les collisions de noms de propriétés dans les objets, notamment lorsqu'on travaille avec des bibliothèques ou des API externes.

```js
let symbol = Symbol("Nom");
```

- Un Symbol est toujours unique, même avec la même description.
- Il peut être utilisé comme clé d’objet, ce qui évite les conflits avec d’autres propriétés.
- Les Symbols ne sont pas énumérables (`Object.keys()` ne les affiche pas), ce qui les rend utiles pour stocker des données privées dans un objet.
- On peut récupérer les Symboles d’un objet avec `Object.getOwnPropertySymbols(obj)`.

```js
let symbol = Symbol("foo");

console.log(typeof symbol);

let obj = {};
obj[symbol] = "some value";

// {Symbol(foo) : "some value" }
console.log(obj);
```

7:46 : DOM (pas pertinent pour React Native)
