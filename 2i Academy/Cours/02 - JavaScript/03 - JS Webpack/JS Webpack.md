# JS Webpack


Server side templating : Le serveur renvoie des pages générées complètement. Besoin de regénérer la page à chaque nouvelle requête, car une nouvelle page HTML est générée

Single Page Application : Les requêtes ne demandent que des données (HTML squelletique), et toute la mise en page est générée par le client grâce à Javascript

Double contrainte :

En exploitation, on cherche un maximum de performance et de fiabilité : On limite les requêtes et le nombre de fichiers, et on utilise les technos anciennes qui ont fait leurs preuves

En production, on a envie d'utiliser des technos modernes pour travailler plus efficacement. Pour optimiser la maintenance on veut faire un maximum de fichiers de modules..

Une solution, webpack : 

Il prend tous les fichiers JS "de travail" de l'application et les aggrège en un seul gros fichier pour déployer une application web optimisée.
Ce n'est plus trop possible de travailler avec car ça devient bordélique, mais c'est plus optimisé pour les interpréteurs.
Il gère également les dépendances des modules JS.
Il peut également réaliser des traitements sur les fichier avant de les agréger (minification, transpilation, hashage...)

Créer un nouveau dossier
run npm init -y
run npm i -D webpack webpack-cli
Créer un dossier src qui contiendra nos fichiers sources
Créer un fichier webpack.config.js dans la racine du dossier de l'application

```js
const path = require("node:path");
module.exports = {
    
 entry: './src/app.js',
 output: {
 path: path.resolve(__dirname, 'dist'),
 filename: 'bundle.js',
 }
}
```

run webpack --mode production | development

On peut créer un serveur webpack

npm i -D webpack-dev-server

(-D = --save-dev)

webpack-dev-server --mode production --open 