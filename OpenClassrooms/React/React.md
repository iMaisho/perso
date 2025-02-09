# React

## Documentation officielle

https://react.dev/

## Installer et configurer React 18

Pour ce cours, j'ai installé React 18 via CRA (Create React App). Il semble y avoir quelques failles de sécurité, le build est déprécié, mais ça fonctionne donc pour apprendre les bases de React ce sera suffisant.

```shell
npx create-react-app mon-app
cd mon-app
npm install react@18 react-dom@18
npm start
```

## La philosophie React

L'idée de React va être de désintégrer notre interface utilisateurs en `composants`, que l'on va pouvoir créer une fois et réutiliser à l'infini. Ces composants pourront eux même être composés de composants plus petits.

Un composant contient tout ce qui est nécéssaire à son bon fonctionnement :

- La structure
- Le style
- Le comportement

On pourra l'utiliser plusieurs fois, en l'hydratant de données différentes pour créer des élements similaires, qui contiennent des informations différentes

### Organiser et Isoler nos fichiers

Lors de la création de notre projet React, tout un tas de fichiers ont été créés.

- Le dossier `node_modules` contient toutes les dépendances de notre code
- Le dossier `public` contient `index.html` et d'autres fichiers publics
- Le dossier `src` contiendra la majorité des fichiers sur lesquels on travaillera

On conserve `App.js` que l'on vient placer dans un sous dossier `components` qui contiendra tous les composants React que l'on créera, ainsi que `index.js` qui initialise notre app et `index.css` qui nous permettra de styliser nos composants.

Lorsque l'on veut créer un composant, on crée un nouveau fichier sous la forme `NomDuComposant.js` dans `components`.

Pour pouvoir les utiliser dans `App.js`, il va falloir les exporter et les importer.

Pour les exporter de `NomDuComposant.js`, on ajoute cette ligne de code à la fin de notre fichier

```js
export default NomDuComposant;
```

Pour les importer dans `App.js`, on ajoute cette ligne de code au début du fichier

```js
import NomDuComposant from "./NomDuComposant";
```

Cette étape est rendue simple grâce à la syntaxe `export default` et `import`, apportée par `Webpack`

## Créer des composants

La création d'un composant comporte 3 étapes.

1. **Créer une div dans notre fichier HTML, et l'identifier grâce à un ID unique.**

```html
<div id="mon-premier-composant-react"></div>
```

2. **Créer ensuite notre élément dans notre fichier JS.**

La méthode historique consistait à créer une classe spécialisée de la classe Component

```js
class MyComponent extends React.Component
```

Mais la méthode moderne consiste à créer une fonction qui a pour valeur de retour les éléments HTML que l'on souhaite afficher

```js
// Version verbeuse
function MyComponent() {
  return <div>Hello OpenClassrooms 👋</div>;
}

// Version flechée
const MyComponent = () => <div>Hello OpenClassrooms 👋</div>;
```

3. Lier notre composant au DOM

Pour cela, on utilise la méthode `.createRoot()`, dans lequel on précise les éléments du DOM que l'on souhaite affecter

```js
// const root = createRoot(domNode, options?)
const root = ReactDOM.createRoot(
  document.getElementById("mon-premier-composant-react")
);
```

Puis on utilise la méthode `.render()` pour l'afficher dans le DOM

```js
root.render(<MyComponent />);
```

On peut utiliser le `React.StrictMode` à cette étape. Cela permet de détecter des erreurs potentielles dans notre code et d'afficher des avertissements en développement, sans impacter la production

```js
root.render(
  <React.StrictMode>
    <MyComponent />
  </React.StrictMode>
);
```

On remarque que `<MyComponent />` ressemble à s'y méprendre à une balise HTML. Il s'agit en fait de `JSX`, une spécificité propre à React.

## Créer des composants à partir d'autres composants

Rien de plus simple, on utilise la méthode vu ci-dessus, en incorporant nos composants dans la fonction de création du composant

```js
const Header = () => <h1>La Jungle</h1>;
const Description = () => (
  <p>Ici achetez toutes les plantes dont vous avez toujours rêvé 🌵🌱🎍</p>
);
const Banner = () => (
  <>
    <Header /> <Description />
  </>
);
```

La fonction fléchée ne doit toujours retourner qu'un seul élément parent.
On pourrait utiliser une `<div>`, mais cela ajouterait un élément inutile dans le DOM.
On utilise donc un `Fragment` : `<>...</>`, élément propre à JSX, pour englober nos composants.

On pourrait également encapsuler des composants, de cette façon :

```js
<Parent>
  <Enfant />
  <Enfant />
  <Enfant />
</Parent>
```

**Note** : En JSX, toutes les balises doivent être fermées, y compris les balises autofermantes comme `<input>` que l'on écrira ainsi :

```js
<input />
```

## Manipuler des données en JSX

En React, les accolades `{ }` sont également particulièrement utiles. Dès qu'il s'agit d'expressions JavaScript, elles sont écrites entre accolades.

Ça nous permet d'appliquer des expressions JavaScript directement dans notre JSX pour :

- faire des maths :

`<div>La grande réponse sur la vie, l'univers et le reste est { 6 * 7 } </div>`

- modifier des chaînes de caractères :

`<div>{ alexia.toUpperCase() }</div> `

- utiliser des ternaires :

`<div>{ 2 > 0 ? 'Deux est plus grand que zéro' : 'Ceci n'apparaîtra jamais }</div>`

- Ou même tout simplement pour afficher une variable JS :

pour une string : `<div>{ myTitle }</div>`

pour un nombre : `<div>{ 42 }</div>`

```js
function Description() {
  const text = "Ici achetez toutes les plantes dont vous avez toujours rêvées";
  const emojis = "🤑🤑🤑";
  // Ici achetez 🤑🤑🤑
  return <p>{text.slice(0, 11) + emojis}</p>;
}
```

## Style et Assets

### Styliser une app React

Comme en HTML, nous pouvons associer des attributs à nos éléments. Les attributs HTML tels que `id`, `href` pour un lien, `src` pour une image, fonctionnent normalement en JSX.

En revanche, `class` est déjà utilisé en JavaScript : on utilise donc l'attribut `className` pour éviter les conflits.

Pour styliser un composant, on vient créer un fichier CSS qui porte son nom dans un dossier `styles`.

Dans notre fichier JS, on vient ajouter une div autour de notre composant, et lui donner un attribut `className`.
On en profite pour importer le fichier CSS en haut de notre fichier JS.

```js
// Fichier JS

import "../styles/Banner.css";

function Banner() {
  return (
    <div className="lmj-banner">
      <h1>La maison jungle</h1>
    </div>
  );
}

export default Banner;
```

```css
// Fichier CSS
.lmj-banner {
  color: black;
  text-align: right;
  padding: 32px;
  border-bottom: solid 3px black;
}
```

### Incorporer un asset

On crée un dossier `assets` dans `src` pour ranger nos fichiers.

Puis, dans le fichier JS du composant dans lequel on souhaite intégrer l'asset, on l'importe au début en la stockant dans une variable

```js
import logo from "../assets/logo.png";
```

On peut ensuite intégrer notre image dans notre composant

```js
function Banner() {
  const title = "La maison jungle";
  return (
    <div className="lmj-banner">
      // Ajout de l'image dans la bannière
      <img src={logo} alt="La maison jungle" className="lmj-logo" />
      <h1 className="lmj-title">{title}</h1>
    </div>
  );
}
```

## Itérations sur une liste

Imaginons que nous avons une liste de produits à vendre et que l'on souhaite les afficher sous forme de liste dans notre site web.

Nous pouvons créer un composant `ShoppingList.js`, dans lequel nous stockons notre tableau.

```js
const plantList = [
  "monstera",
  "ficus lyrata",
  "pothos argenté",
  "yucca",
  "palmier",
];
```

Puis, dans notre composant, nous itérons sur cette liste grâce à la méthode `map()` pour générer un élément HTML pour chaque élément de notre liste.

```js
function ShoppingList() {
  return (
    <ul>
      {plantList.map((plant) => (
        <li>{plant}</li>
      ))}
    </ul>
  );
}
```

Cela fonctionne, mais on peut apercevoir une erreur dans la console...

```shell
runtime.js:7 Warning: Each child in a list should have a unique "key" prop.

Check the render method of `ShoppingList`. See https://reactjs.org/link/warning-keys for more information.
    at li
    at ShoppingList
    at App
```

### Les keys

Les `key` sont utilisées en React pour identifier de manière unique chaque élément d'une liste. Elles aident React à **optimiser le rendu** en identifiant quels éléments ont changé, ont été ajoutés ou supprimés. Sans `key`, React pourrait mal gérer les mises à jour de la liste.

Elles doivent donc être **uniques et stables dans le temps**.

Pour cela, on a plusieurs possibilités :

- La meilleure méthode consiste à utiliser l'**id associée à votre donnée dans votre base de données**.

- Vous pouvez également trouver un moyen d'exploiter la valeur de la donnée, si vous avez la certitude qu'elle sera toujours unique, et stable dans le temps.

- En dernier recours, vous pouvez définir une string et la combiner avec l'index de la data dans votre tableau.

Dans notre cas, vu qu'on travaille sans **base de données**, on ne peut pas avoir un ID persistant. On va donc utiliser une méthode moins fiable, en créant un ID à partir de l'index et de la valeur de la donnée grâce à `map()`

```js
<ul>
  {plantList.map((plant, index) => (
    <li key={`${plant}-${index}`}>{plant}</li>
  ))}
</ul>
```

## Conditions d'affichage

Pour afficher des éléments en fonction d'une condition, on peut utiliser les `ternaires`.

```js
// Affiche 🔥 si la propriété "isBestSale" est true pour la plante
// Sinon, n'affiche rien
{
  plant.isBestSale ? <span>🔥</span> : null;
}
```

En JSX, on peut également utiliser `&&` pour indiquer que ce qui suit se sera affiché que si la condition précédente est remplie.

```js
{
  plant.isBestSale && <span>🔥</span>;
}
```

**Attention** : `&&` et `||` restent quand même les symboles du `ET` et du `OU` logique.

On peut évidemment isoler notre code conditionnel dans un nouveau composant, et l'importer dans le composant qui l'utilisera.

On peut utiliser les `if`, les `switch` etc...

## Les props

Les `props` (propriétés) sont un moyen de passer des informations d'un composant **parent** à un composant **enfant**.

En gros, elles permettent de rendre un composant réutilisable en lui envoyant des valeurs dynamiques.

`props` est un simple objet, qui contient des propriétés.

### Déclarer un prop, dans le composant enfant

On peut commencer par déclarer un composant qui accepte des props. Ici, le composant `Message` reçoit un prop nommé `text`.

```jsx
function Message(props) {
  return <p>{props.text}</p>;
}
```

On peut également utiliser une fonction fléchée

```jsx
const Message = (props) => {
  return <p>{props.text}</p>;
};
```

Etant donné qu'on vient chercher la propriété `text` dans ce props, il faudra s'assurer que le parent envoie bien une valeur `text`

Une façon plus propre de déclarer son `props` est de le **déstructurer** à la déclaration

```jsx
const Message = ({ text }) => {
  return <p>{text}</p>;
};
```

Cela évite d'avoir à utiliser la syntaxe d'objet `props.text`

### Envoi des données par le parent

```js
{
  /* Envoi de la valeur "Bonjour !" à la propriété "text" du prop "Message" */
}
<Message text="Bonjour !" />;
```

Le composant Message est appelé dans le parent avec une prop nommée text qui a pour valeur "Bonjour !".

React va transformer cet appel en un objet `{ text: "Bonjour !" }`, et l'envoyer au composant Message.

Au final, c'est un peu comme si on créait un objet `Message` qui contenait des propriétés, ici seulement `text`.

Cela nous permet de créer des composants similaires avec des valeurs différentes très simplement !

L'enfant gèrera la structure dans le DOM:

```js
// Dans l'enfant
const Product = ({ name, price }) => {
  return (
    <div>
      <h2>{name}</h2>
      <p>Prix : {price}€</p>
    </div>
  );
};
```

Le parent hydrate les objets avec les valeurs de notre choix

```js
// Dans le parent
function ProductList() {
  return (
    <div>
      <Product name="Monstera" price={8} />
      <Product name="Lierre" price={10} />
    </div>
  );
}
```

Cela nous créera deux composants Product, qui auront chacuns leurs spécificités.

```yaml
Monstera
Prix : 8€

Lierre
Prix : 10€
```

En pratique, une prop peut avoir n’importe quelle valeur possible en JavaScript, mais syntaxiquement, en JSX, on n’a en gros que deux possibilités :

- un littéral String , matérialisé par des guillemets `""` ;

- pour tout le reste (booléen, number, expression Javascript, etc.), des accolades `{}`.

### Un props particulier : children

`props.children` est un prop spécial qui permet à un composant d'afficher le contenu placé entre ses balises

Il permet de créer des composants généraux (Cards, Modal, Button) et d'imbriquer plusieurs éléments dynamiquement à l'intérieur.

```jsx
// Déclaration dans l'enfant
const Card = ({ children }) => {
  return <div className="card">{children}</div>;
};
```

Au lieu d'appeler classiquement notre composant avec une balise autofermante...

```jsx
// Erreur
<Card children="..." />
```

...le props children est automatiquement injecté, et nous permet d'imbriquer notre contenu de cette façon :

```jsx
<Card>"..."</Card>
```

Par exemple, on pourra ainsi afficher :

```jsx
// Appel dans le parent
<Card>
  <h2>Titre de la carte</h2>
  <p>Contenu dynamique</p>
</Card>

// Résultat
<div class="card">
  <h2>Titre de la carte</h2>
  <p>Contenu dynamique</p>
</div>
```

## Evènements en React

React permet de simplifier la syntaxe de réaction aux actions de l'utilisateur, comparé à JS natif.

Quelques informations :

- l'événement s'écrit dans une balise en `camelCase`;

- on déclare l'événement à capter, et lui passe entre accolades la fonction à appeler ;

- contrairement au JS, dans la quasi totalité des cas, on a **pas besoin d'utiliser addEventListener**.

Les évènements en React sont appelés `évènements synthétiques`. Ils sont similaires aux évènements JS, mais sont supportés par tous les navigateurs.

Cela implique également que l'on a accès à `preventDefault` et `stopPropagation`

**_La liste des évènements de React :_** https://react.dev/reference/react-dom/components/common#react-event-object

### Créer un évènement basique

Pour commencer, on vient écrire le comportement déclenché par l'évènement, dans une fonction

```jsx
function handleClick() {
  console.log("✨ Ceci est un clic ✨");
}
```

Puis, sur notre élément, on vient ajouter une propriété, ici `onClick`, qui aura pour valeur le nom de notre fonction entre accolades

```jsx
<li className="lmj-plant-item" onClick={handleClick}>
  ...
</li>
```

### Créer un évènement avec un paramètre

Imaginons que nous souhaitons modifier la fonction `handleClick()` pour qu'elle accepte le nom d'une plante en paramètre, et que le message change en fonction de la plante cliquée.

```jsx
function handleClick(plantName) {
  alert(`Vous voulez acheter 1 ${plantName} ? Très bon choix 🌱✨`);
}
```

Le comportement n'est pas le comportement souhaité :

- Si on conserve notre appel `onClick={handleClick}`, React passera automatiquement l'objet `event` en paramètre, ce qui fait que `plantName` sera `[object Object]` au lieu du nom de la plante."

- Si on change notre appel pour qu'il accepte un paramètre `onClick={handleClick(name)}`, l'affichage sera correct, mais React exécutera immédiatement `handleClick(name)` au moment du rendu du composant, **sans attendre le clic de l'utilisateur**.

Pour que `handleClick(name)` ne soit exécuté qu'au moment du clic, il faut l'englober dans une fonction anonyme. Les fonctions fléchées sont idéales pour ce genre de cas de figure :

```jsx
onClick={() => handleClick(name)}
```

### Gérer les formulaires en React

En React, la gestion des formulaires est simplifiée : on a accès à la valeur très facilement, quel que soit le type d'input.

#### Formulaires non contrôlés

```jsx
<form onSubmit={handleSubmit}>
  <input type="text" name="my_input" defaultValue="Tapez votre texte" />
  <button type="submit">Entrer</button>
</form>;

// Affiche la valeur de l'input dans une fenête d'alterte, sans rafraîchir la page
function handleSubmit(e) {
  e.preventDefault();
  alert(e.target["my_input"].value);
}
```

Les formulaires non contrôlés nous permettent de ne pas avoir à gérer trop d'informations. Mais cette approche est un peu moins "React", parce qu'elle ne permet pas de tout faire : React n'a aucun contrôle sur ce qui est saisi. Impossible de valider ou modifier la valeur avant qu’elle ne soit affichée.

#### Formulaires contrôlés

Pour pouvoir faire un formulaire contrôlé, on a besoin de connaître la notion de `state`, qu'on verra un peu plus tard.

Pour l'instant, disons seulement que le `state local` nous permet de garder des informations. Ces informations sont spécifiques à un composant et elles proviennent d'une interaction que l'utilisateur a eue avec le composant.

- React contrôle ce qui est affiché → On peut modifier ou valider l’entrée avant qu’elle soit enregistrée.
- Permet de filtrer les entrées (ex: empêcher certains caractères).
- Facilite la gestion des erreurs et validations.

```jsx
import { useState } from "react";

function QuestionForm() {
  const [inputValue, setInputValue] = useState("Posez votre question ici");

  return (
    <div>
      <textarea
        value={inputValue}
        onChange={(e) => setInputValue(e.target.value)}
      />
    </div>
  );
}
```

Quand l’utilisateur tape dans l’input, l’événement `onChange` est déclenché.
Au lieu que l’input se mette à jour tout seul, React prend le contrôle :

- On récupère la valeur tapée avec `e.target.value`.
- On la stocke dans `useState` avec `setInputValue`.
- On lie la valeur de l’input à inputValue (value={inputValue}).

Ainsi, React décide quelle valeur est affichée.

#### Exemples d'intéractions avec l'input

1. **Déclencher une alerte avec le contenu de l'input**

Comme `inputValue` contient la valeur de l’input en temps réel, on peut l’afficher avec un bouton :

```jsx
<button onClick={() => alert(inputValue)}>Alertez-moi 🚨</button>
```

2. **Afficher un message d'erreur si la valeur est invalide**

```jsx
const isInputError = inputValue.includes("f");

{
  isInputError && (
    <div>🔥 Vous n'avez pas le droit d'utiliser la lettre "f" ici.</div>
  );
}
```

`isInputError` devient true si "f" est dans inputValue, et grâce au &&, **React affiche l’erreur seulement si c’est vrai**.

3. **Bloquer une mauvaise valeur avant qu'elle ne s'affiche**

Si on veut empêcher complètement d’écrire "f", on peut intercepter l’entrée avant de la stocker :

```jsx
function checkValue(value) {
  if (!value.includes("f")) {
    setInputValue(value);
  }
}
```

On l’utilise dans `onChange` :

```jsx
onChange={(e) => checkValue(e.target.value)}
```

✅ Maintenant, il est impossible de taper "f" !

#### Quand Utiliser un Formulaire Contrôlé ?

- On veut valider/modifier l’entrée avant qu’elle ne soit affichée (ex: interdire certains caractères).
- On veut afficher un message d’erreur en fonction de l’entrée.
- On veut récupérer la valeur de l’input pour l’envoyer à un serveur.

Un formulaire non contrôlé peut suffire si :

- L’input n’a pas besoin de validation ni de modification.
- React ne doit pas surveiller la valeur en temps réel.

**Mais dans 90% des cas, on utilise des formulaires contrôlés, car ils offrent beaucoup plus de contrôle.**

Si on gère plusieurs inputs dans un gros formulaire, useState devient vite complexe.
👉 On peut alors utiliser `react-hook-form`, une bibliothèque très efficace pour gérer les formulaires.

## State

### Déclarer et utiliser un State

On Commence par importer `useState` avec :

```jsx
import { useState } from "react";
```

Puis, on peut créer un state. Nous devons déclarer en même temps une fonction pour mettre à jour ce state, et lui attribuer une valeur initiale, qui sera ici de 0 :

```jsx
// Déclaratation du state "cart" et cart = 0;
const [cart, updateCart] = useState(0);
```

Si on vient créer un bouton comme ceci :

```jsx
<button onClick={() => updateCart(cart + 1)}>Ajouter</button>
```

A chaque fois qu'on viendra cliquer sur notre bouton, la valeur du State `cart` sera incrémentée.

Lorsqu'un state est modifié, alors l'affichage du composant est rafraichit et la valeur affichée est actualisée, on dit que le composant est **re-render**.

Notre composant Cart est maintenant devenu un stateful component, grâce à `useState` .

Concrètement, cela veut dire que le composant Cart peut être re-render autant de fois que nécessaire, mais la valeur du panier sera préservée.

### Précisions sur useState

Expliquons cette syntaxe de déclaration de State :

```jsx
const [cart, updateCart] = useState(0);
```

`[cart, updateCart]` est une syntaxe de déstructuration pour un tableau
`useState(n)` retourne un tableau de taille 2 : [n, fonction];

Cela revient à écrire

```jsx
const cartState = useState(0);
const cart = cartState[0];
const updateCart = cartState[1];
```

``n` correspond à l'état initial de notre state. Cet état initial peut être **un nombre** comme ici, **une string, un booléen, un tableau ou encore un objet avec plusieurs propriétés**.

### Déclarer plusieurs States dans un composant

On peut déclarer plusieurs variables d'état pour un même composant. Imaginons ici qu'on souhaite créer un bouton qui permette d'afficher ou de cacher le panier.

Il suffit de déclarer un nouveau State `isOpen`

```jsx
const [isOpen, setIsOpen] = useState(false);
```

Puis on crée deux boutons pour afficher ou masquer le composant, que l'on affiche grâce à une condition basée sur la valeur de `isOpen`

```jsx
function Cart() {
  const monsteraPrice = 8;
  const [cart, updateCart] = useState(0);
  const [isOpen, setIsOpen] = useState(false);

  return isOpen ? (
    <div className="lmj-cart">
      <button onClick={() => setIsOpen(false)}>Fermer</button>
      <h2>Panier</h2>
      <div>
        Monstera : {monsteraPrice}€
        <button onClick={() => updateCart(cart + 1)}>Ajouter</button>
      </div>
      <h3>Total : {monsteraPrice * cart}€</h3>
    </div>
  ) : (
    <button onClick={() => setIsOpen(true)}>Ouvrir le Panier</button>
  );
}
```

### Partager un State entre plusieurs composants

Comment faire pour **changer le comportement d'un composant en fonction du state d'un autre composant** ? Par exemple, si je veux enfin ajouter un lien entre mon `Cart` et mon composant `ShoppingList`. Je peux créer un bouton "Ajouter au panier" dans chaque PlantItem ... Mais comment faire pour venir compléter mon panier en fonction ?

Comme son nom l'indique, un state local est local. Ni les parents, ni les enfants ne peuvent manipuler le state local d'un composant (ils n’en ont pas la possibilité technique).

Pour pouvoir transmettre des données d'un composants vers un autre, **il faudra faire remonter ces données vers le state local du plus proche composant qui est un parent commun, et y garder le state.** À partir de là, il sera possible de :

- Faire **redescendre ces infos avec des props** jusqu’aux composants qui en ont besoin.
- Faire **« remonter » les demandes d'update toujours dans les props.** Pour cela, on peut utiliser la **fonction de mise à jour du state récupérée dans `useState`, en la passant en props aux composants qui en ont besoin**.

**Note :** _La "bonne pratique" est en effet de déclarer les States dans les éléments parents, pour que les enfants n'aient comme seule responsabilité d'afficher les éléments transmis via les props. Mais il peut y avoir des cas de figure où c'est mieux de déclarer un State dans l'élément enfant. Ca s'apprend avec le temps et l'expérience._

```jsx
function App() {
  // Déclaration du State cart
  const [cart, updateCart] = useState(0);

  return (
    <div>
      <Banner>
        <img src={logo} alt="La maison jungle" className="lmj-logo" />
        <h1 className="lmj-title">La maison jungle</h1>
      </Banner>
      <div className="lmj-layout-inner">
        // On transmet cart aux éléments enfants qui en ont besoin
        <Cart cart={cart} updateCart={updateCart} />
        <ShoppingList cart={cart} updateCart={updateCart} />
      </div>
      <Footer />
    </div>
  );
}

export default App;
```

On peut ensuite appeler notre fonction dans les enfants :

```jsx
function Cart({cart, updateCart}){
  ...
  // Permet d'afficher un bouton dans le panier pour vider son contenu
  <button onClick={() => updateCart(0)}>Vider le panier</button>
  ...
}
```

```jsx
function ShoppingList({ cart, updateCart }) {
  ...
  // Permet d'ajouter un bouton sur chaque plante pour les ajouter au panier
  <button onClick={() => updateCart(cart + 1)}>Ajouter au panier</button>
  ...
}
```

**Note:** _Ici, nous sommes sur une petite application : il n'y a qu'une seule page et nous partageons le state directement entre parents et enfants. Mais la notion de state management va beaucoup plus loin pour de plus grosses applications : il existe des outils dédiés au State Management tels que `Flux`, `Redux` ou des solutions natives comme `React Context`._

### Un exemple plus poussé

Pour l'instant, ce panier ajoute une monstera à 8eu, sans prendre en compte le type de plante que l'on compte ajouter au panier.

**Note : \***On a ajouté une propriété `price` à nos plantes dans la base de donnée (ici `plantList.js`)\*

Pour commencer, on vient changer notre déclaration du State `cart` dans `App.js` pour le typer en tableau plutôt qu'en int

```jsx
const [cart, updateCart] = useState([]);
```

Dans `Cart.js`, on déclare `total` en utilisant `reduce()` sur cart pour calculer le total des prix, et dont la valeur est 0 si `cart` est un tableau vide

```jsx
const total = cart.reduce(
  (acc, plantType) => acc + plantType.amount * plantType.price,
  0
);
```

Et on utilise `map()` sur cart pour afficher chacune des plantes contenues dans `cart`

```jsx
{
  cart.map(({ name, price, amount, id }, index) => (
    <div key={id}>
      {name} {price} x{amount}
    </div>
  ));
}
```

Enfin, dans `ShoppingList.js` qui gère l'affichage de nos produits, on vient ajouter une fonction `addToCart()` qui sera appelée au click des boutons de chaque plante.

```jsx
<button onClick={() => addToCart(name, price)}>Ajouter au panier</button>
```

Voici la fonction qui permet de générer un nouveau tableau avec les données de nos plantes ajoutées au panier :

```jsx
function addToCart(name, price) {
  // On vérifie si la plante que l'on ajoute est déjà dans le tableau
  const currentPlantAdded = cart.find((plant) => plant.name === name);
  if (currentPlantAdded) {
    // Si oui, on crée un nouveau tableau sans cette plante..
    const cardFilteredCurrentPlant = cart.filter(
      (plant) => plant.name !== name
    );
    // ..auquel on ajoute à nouveau la plante, avec une nouvelle valeur pour amount
    updateCart([
      ...cardFilteredCurrentPlant,
      { name, price, amount: currentPlantAdded.amount + 1 },
    ]);
  } else {
    // Sinon, on ajoute directement notre plante à cart, en initialisant amount à 1
    updateCart([...cart, { name, price, amount: 1 }]);
  }
}
```

### Immutabilité des states

https://blog.eleven-labs.com/fr/vous-utilisez-mal-les-states-react/

Une bonne pratique est de ne jamais modifier directement les propriétés de nos States, mais de créer un nouvel objet de notre nouvel état et de le passer à notre state.

```jsx
const UnComposant = () => {
  const [object, setObject] = useState({
    name: "MacGuffin",
    click: 0,
  });

  // A NE PAS FAIRE
  const handleClick = () => {
    object.click = object.click + 1;
    setObject(object);
  };

  // BONNE PRATIQUE
  const handleClick = () => {
    setObject({ ...object, click: object.click + 1 });
  };

  return <div onClick={handleClick}>{object.click}</div>;
};
```

Cela permet de considérablement aider React à détecter les modifications d’état et donc à éviter les bugs car qui dit nouvel objet dit nouvelle référence, et la différence de ref entre les états A et B est plus facile à comparer que toutes les propriétés une par une.

## useEffect

Imaginons que l'on souhaite afficher une alerte à chaque fois qu'on ajoute un élément à notre panier.

- Si on le met **juste avant le return**, ça ne marcherait pas car l'alerte s'afficherait à chaque render, et bloquerait l'affichage tant qu'on ne clique pas sur "OK"

- Si on le met **juste après le return**, ça ne marcherait pas car ce code n'est jamais exécuté

Ici, on doit utiliser **un effet de bord**, qui déclenche une action en parallèle de l'exécution de notre code, à chaque render de notre composant.

Pour notre exemple, cela donnerait :

```jsx
import { useState, useEffect } from 'react'
...

function Cart(...){
  ...
  useEffect(() => {
    alert(`J'aurai ${total}€ à payer 💸`)
  })
  ...
}
```

### Conditionner le déclenchement de useEffect

Dans cet exemple l'alerte s'affiche bien quand on ajoute un élément à notre panier, mais également lorsqu'on masque ou qu'on affiche notre panier. C'est normal : `useEffect` est appelé **à chaque fois que React fait un rendu du composant**

Pour corriger cela, on passe en deuxième argument de la fonction useEffect un tableau de dépendances.

```jsx
useEffect(() => {
  alert(`J'aurai ${total}€ à payer 💸`);
}, [total]);
```

Dans ce cas, `useEffect` ne sera appelée que si la valeur de `total` change. On peut passer **autant de variables qu'on le souhaite** pour ajuster le comportement.

**Note :** _`useEffect` est appelé au premier rendu de notre composant. Si l'on souhaite l'appeler à ce moment là seulement, par exemple pour **récupérer des données grâce à une API**, on passe un **tableau de dépendances vide** à `useEffect`._

À partir du moment où on utilise le tableau de dépendances, il faut bien faire attention à ne pas oublier des dépendances, ou bien à ne pas en laisser qui n'ont plus rien à y faire, pour éviter d'exécuter à des moments inopportuns.

### Une utilisation particulière : le `Cleanup`

En React, lorsque un composant **est retiré du DOM** (unmount), certains effets peuvent continuer à tourner en arrière-plan et **provoquer des fuites de mémoire**. Pour éviter cela, on effectue un nettoyage (cleanup) dans `useEffect()`.

Si un effet crée **un interval, un event listener ou une requête asynchrone**, il continue d’exister même après le démontage du composant.

#### Cas 1 : `setInterval` et `setTimeout`

```jsx
function Timer() {
  const [seconds, setSeconds] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setSeconds((s) => s + 1);
    }, 1000);
  }, []);
}
```

Pour palier ce problème, on retourne une **fonction de nettoyage** dans `useEffect`. Dans ce cas, il faudra appeler `clearInterval` ou `clearTimeout`

```jsx
useEffect(() => {
  const interval = setInterval(() => {
    setSeconds((s) => s + 1);
  }, 1000);

  // La fonction de nettoyage est la valeur de retour de useEffect
  return () => {
    // Nettoyage de l'intervalle quand le composant est démonté
    clearInterval(interval);
  };
}, []);
```

#### Cas 2 : `addEventListener`

Doit être nettoyé avec `removeEventListener`

#### Cas 3 : Requêtes asynchrones (`fetch`, `axios`, WebSocket)

Doit être nettoyé avec `AbortController`

### Quelques règles d'utilisation

- Toujours appeler `useEffect` à la **racine du composant**. Ne pas l'appeler à l’intérieur _de boucles, de code conditionnel ou de fonctions imbriquées_. Ainsi, on s'assure d'éviter des erreurs involontaires.

- Comme pour `useState`, `useEffect` est uniquement accessible dans un composant fonction React. Donc ce n'est pas possible de l'utiliser dans un composant classe, ou dans une simple fonction JavaScript.

- Il vaut mieux séparer les différentes actions effectuées dans différents `useEffect`.
