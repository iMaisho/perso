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
