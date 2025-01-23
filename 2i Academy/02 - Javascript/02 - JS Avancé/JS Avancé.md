# JS avancé
<a href="https://www.jsv9000.app/">Javascript visualizer 9000</a>


Pour éxecuter du Javascript, on peut utiliser un navigateur et la console dans l'inspection, ou on peut utiliser NodeJS en utilisant la commande `node this` sur VSCore, ou `node cheminDuFichier` via powershell ou cmd en dehors de VSCode.

## Fonctions

Les fonctions orientées objet ont une syntaxe différentes des fonctions procédurales.

Au lieu d'utiliser `functionName(target)`, on va écrire `target.functionName`.
Cela permet de limiter le nombre d'arguments à passer à la fonction. En procédurale on peut vite se retrouver avec des fonctions qui attendent 5 arguments ou plus, et c'est chiant de les appeler.

### Callback

Une fonction de rappel (aussi appelée callback en anglais) est une fonction passée dans une autre fonction en tant qu'argument, qui est ensuite invoquée à l'intérieur de la fonction externe pour accomplir une sorte de routine ou d'action.

```javascript
function salutation(name) {
  alert("Bonjour " + name);
}

function processUserInput(callback) {
  var name = prompt("Entrez votre nom.");
  callback(name);
}

processUserInput(salutation);
```

L' exemple ci-dessus est un rappel synchrone et il est exécuté immédiatement.

Notez cependant que les rappels sont souvent utilisés pour continuer l'exécution de code après l'achèvement d'une opération asynchrone — ceux-ci sont appelés les rappels asynchrones.

Cette méthode permet de spécifier des attributs pour permettre à une fonction large de répondre à un besoin spécifique à l'utilisateur.

### Arrow functions

### this

https://www.codementor.io/@dariogarciamoya/understanding-this-in-javascript-with-arrow-functions-gcpjwfyuc

## Libraries (npm)

`npm` pour node packet manager est une outil qui ermet de télécharger et d'installer des logiciels pour un projet grâce à des appels dans le terminal.

Les logiciels du type ont un dépot, puis on leur fait une requête en spécifiant ce que l'on souhaite installer et le serveur nous renvoi le logiciel.

On peut créer un fichier de configuration pour notre projet où l'on pourra renseigner le nom, les auteurs, la version et tout un tas d'informations intéressantes sous la forme d'un JSON.

```shell
npm init -y
```

Puis on peut installer des logiciels ou des bibliothèques grâce à la commande `i` ou `install`

```shell
npm i libraryName --save
```

`i` pour install
`--save` pour intégrer le module et sa version dans le JSON d'information.

Un élément "depedencies" est créé dans le JSON. Il s'agit d'un dictionnaire contenant tous les noms de modules et leurs versions, il y a une syntaxe particulière pour spécifier les updates autorisées pour ce projet en particulier. *voir 4-jsavancé diapo 76*.

Lorsqu'on fait une mise en ligne, pour s'assurer qu'on envoie par des fichiers inutiles, on va utiliser un bundler qui va optimiser nos fichiers pour le navigateur, comme `webpack` par exemple.

## Classes

La syntaxe pour créer et instancier une classe en Javascript est similaire à la syntaxe de JAVA.

```js
class Person {
 constructor(name, age) {
 this.name = name;
 this.age = age;
 }
 greet() {
 console.log(`Bonjour, je m'appelle ${this.name}.`);
 }
}
const charlie = new Person("Charlie", 28);
charlie.greet();
```

La syntaxe est assez similaire à la création d'un objet littéral, mais la différence est qu'on peut créer des instances de cette classe, en créant un nouvel objet, ici `Charlie` qui a `28` ans.

Ce nouvel objet contiendra également les méthodes qui sont associées à la classe à partir de laquelle il est instancié, on pourra donc les appeler sur lui, comme `greet` ici.

La classe peut être considérée comme un moule, on passera les ingrédients en arguments à l'instanciation pour créer un nouveau gâteau.

L'objectif de la modélisation (création d'une classe pour réprésenter un élément réel, comme par ici une personne) est de simplifier cet élément en incluant que les données qui lui sont liées dont on a besoin pour notre usage.

En général on met une majuscule au nom des classes, et on nomme le fichier avec le nom de la classe, également avec une majuscule.

```javascript
// Exemple de la modélisation et de l'instanciation d'un panier de site de vente en ligne.
class Cart {

    constructor() {
        this.items = [];
    }
    addProduct (product) {
        const existingProduct = this.items.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        }
        else {
            this.items.push({id: product.id, price: product.price, quantity: 1 });
        }
    }
    getTotalValue () {
        return this.items
            .map(item => item.price * item.quantity)
            .reduce((sum, price) => sum + price);
    }
}

newCart = new Cart();

// On peut imaginer que ces données seraient récupérées en JSON, grâce à une requête API
newCart.addProduct({ id: "clavier", price: 500 })
newCart.addProduct({ id: "clavier", price: 500 })


console.log(newCart.getTotalValue())
```

### Héritage

Une classe peut hériter d'une autre classe, on peut mettre ça en place si on peut dire `ClasseEnfant "est un" ClasseParent`

Par exemple, un étudiant est une personne donc si j'ai une classe `Person` et une classe `Student` je peux utiliser ce permier pour créer ce dernier :

```javascript
class Person{
    constructor(name, age){
        this.name = name;
        this.age = age;
    }*

    ...
}

class Student extends Person {
    constructor(name, age){
        super(name, age);
        this.grades = [];
    }
    ...
}
```

L'intéret de ce comportement est, d'une, de gagner du temps en récupérant une partie de son code pour spécialiser une classe. Mais d'autant plus, si une méthode attend une personne en argument, elle pourra accépter un étudiant, car il hérite de `Person`

Javascript ne permet pas l'héritage multiple.

### Composition

Si on peut dire `Classe1 possède un/des Classe2`, on va faire une composition.

Par exemple, il y a des étudiants dans une salle de classe. Donc on peut créer une Classe `Classroom` qui contiendra une méthode qui permet d'ajouter des instances de `Student`, qui existent en dehors de la salle de classe. On appelle ça une composition faible.

```javascript
class Classroom {
    constructor(teacher){
        this.students = [];
        this.teacher = teacher;
    }

    addStudent(student){
        this.students.push(student)
    }
}

const sophie = new Student('Sophie', 20);
classroom.addStudent(sophie);
```

Une composition forte créerait les instances au sein de la classe, c'est à dire que supprimer la classe supprimerait les étudiants qui étaient dedans. On veut rarement ce comportement.

### Méthodes et propriétés privées

Ces méthodes ou propriétés ne sont accessibles qu'à l'intérieur de la classe. Pour les configurer, on ajoute un `#` devant leur nom.

Par exemple, pour changer la valeur d'une propriété balance sur un compte en banque, on devrait obligatoirement passer par des méthodes publiques `deposit` ou `withdraw` sans pouvoir modifier directement la valeur de `#balance`

```javascript
class BankAccount {
 #balance;
 constructor(balance) {
 this.#balance = balance;
 }
 deposit(amount) {
 this.#balance += amount;
 }
 withdraw(amount{
    this.#balance -= amount;
 })
 getBalance() {
 return this.#balance;
 }
}
const account = new BankAccount(1000);
account.deposit(500);
console.log(account.getBalance());
// Provoque une erreur
console.log(account.#balance);
```

## Modules

La création de modules présentent plusieurs intérêts

- Résoudre les problèmes d'organisation des scripts dans un fichier unique.
- Isoler une partie de son code pour éviter de polluer ses programmes.
- Permettre de réutiliser ses modules d'un fichier à un autre

Les systèmes de gestion de modules sont spécifiques aux frameworks, et existent maintenant en Javascript natif.

On se crée un fichier module, qui contiendra des exports de fonctions ou même de constantes précisés grâce au mot clef `export`.

```javascript
// Exportation de fonctions
export function add (a, b) {
 return a + b;
}

// Exportation d'une arrow function
export const cube = a => a ** 3;
```

On vient également le copier dans le dossier du projet dans lequel on souhaite l'utiliser, et on l'importe dans notre fichier grâce au mot clef `import` en précisant le chemin de notre dossier racine jusqu'au fichier de module.

```javascript
// Importation du module
import { add, cube }
 from './libs/math.js';
// Utilisation des fonctions du module
console.log(add(4, 3));
console.log(cube(3));
```

Un fichier Javascript qui importe des modules est lui même considéré comme un module. Pour pouvoir l'utiliser dans une fenêtre HTML, on utilisera la balise script avec l'argument `type="module"`

```javascript
<script type="module" src="index.js"></script>
```

**Il faut se forcer à organiser son code en module pour les raisons citées précédemment. Cela nous permet également de travailler de façon itérative, sur des petits problèmes, puis de réaliser des tests unitaires réguliers pour faciliter le déboggage.**

## Asynchrone

Javascript est un outil monotâche, chacune des actions est ajoutée à la Stack avec une organisation LIFO.

Lorsqu'on fait une requête à un serveur, l'appel est mis en attente dans la `Task Queue` en libérant sa place dans la `Call Stack`. Cela permet, en attendant la réponse du serveur, de pouvoir continuer à exécuter du code.

C'est le principe d'asynchronicité.

Une fois que le serveur aura renvoyé une réponse, notre tâche sera intégrée à nouveau dans la `Call Stack`, et sera executée.

### Fetch

Cette méthode permet de récupérer et d'envoyer des données à un serveur distant, qui nous appartient ou non, grâce à des API.

On envoie une requête http à un serveur sans provoquer le rechargement de la page. Cette fonction retourne une promesse de réponse du serveur, qui sera ensuite résolue quand on recevra les réponses du serveur (ou une erreur.)

```javascript
const URL = "https://randomuser.me/api";

fetch(URL)
 .then(response => {
    console.log(response);
    // test des erreurs du serveur
    if(response.ok){
        return response.json()
    } else {
        console.log("Erreur "+ response.status)
    }
    })
    // chaînage de la promesse
    .then(data => console.log(data))
    // gestion globale des erreurs
    // sur toutes les promesses de la chaîne
    .catch(error => console.log(error));
```

`.then` assigne la valeur de retour de la fonction précedente à la variable passée à la prochaine fonction anonyme.

`.catch`.catch permet d'intercepter les erreurs à n'importe quel étape de notre code. Donc c'est pratique.

### async

On peut écrire une fonction qui ressemble à du synchrone, en ajoutant `async` avant de déclarer la fonction, et en séparant nos étapes avec le mot clef `await`

```javascript
const URL = "https://randomuser.me/api";

async function getOneUser(){
 // On attend la réponse avant d'éxécuter
 // le reste du code
    const response = await fetch(URL);
    if(response.ok){
        const data = await response.json();
        console.log(data);
    } else {
        console.log("Erreur "+ response.status);
    }
}
```

Pour pouvoir gérer les problèmes, on integre l'appel de notre fonction dans un `try` avec un `catch`.

```javascript
try {
 getOneUser();
} catch(error){
 console.log(error);
}
```

### CRUD : Create, Read, Update, Delete

Le JSON est un objet en binaire, donc ne peux pas être transmis en HTML. Il faut le transformer en chaînes de caractères en utilisant `JSON.stringify`.

Le processus inverse (conversion d'une chaîne de caractères en objet JSON) peut être fait dans `fetch` grâce à la méthode `.json`, ou en dehors de fetch avec `JSON.parse(string)`

Si une application est RESTful, on peut CRUD les données. REST est une convention.

Cela peut permettre par exemple, si on a une application web et une application mobile, de travailler sur la même base de données.

#### Ajouter des données : la méthode POST

```javascript
const URL = "https://reqres.in/api/users/";

async function saveUser(userData) {
    const response = await fetch(URL, {
        method: "POST",
        body: JSON.stringify(userData),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
        }
    });
    const result = await response.json();
    console.log(result);
}

saveUser({
 name: "Paul Atreides",
 username: "muadbid"
});
```

#### Modifier des données : la méthode PUT

#### Supprimer des données : la méthode DELETE

```javascript
const URL = "https://reqres.in/api/users";
async function deleteUser(id) {
 const response = await fetch(URL + id, {
 method: "DELETE",
 });
 // Ici pas de retour json mais un objet response
 // avec des propriétés ok et status
 console.log(response);
}
deleteUser(232);
```

Pas besoin des headers car ils spécifie le contenu de body, mais pas de body dans une requête DELETE.

### JSON Serveur

On pourrait vouloir avoir notre propre base de données rapidement pour faire des tests, que l'on emploira pas en production. Pour cela on peut créer un JSON serveur, qui nous permettrait d'avoir une API REST et qui stockerait les données dans un fichier JSON.

```shell
npm install -g json-server
```

On crée notre fichier JSON avec notre structure de données

```JSON
{
 "posts": [
 {
 "id": 1, "title": "Ionic c'est super",
 "userId": 1, "createdAt": "2018-01-01"
 },
 ],
 "comments": [
 {
 "id": 1, "body": "Vraiment super", "postId": 1
 }
 ],
 "users": [{ "id":1, "name": "seb", "role": "user"}]
}
```

`users` est une collection, donc son nom est au pluriel.
`userId` dans `posts`est une clef étrangère provenant de `users`. JSON Server est capable de faire le lien directement, car son nom est `le nom de la collection au singulier + la clef primaire de cette collection`

## Best practices

Je le répète mais il est important d'isoler ses classes et ses méthodes, pour pouvoir les appeler dans différents projets.
Il faut également créer des petites fonctions pour chaque manipulation plutôt que de créer une seule grosse fonction, afin de clarifier le code à l'utilisation, et limiter les bugs.

`hydrate` : Terme utilisé pour une fonction qui injecte les données d'un formulaire ou autre dans une instance de notre classe.

Make it work > Make it nice > Make it fast

