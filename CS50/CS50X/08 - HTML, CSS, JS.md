# HTML, CSS, JS

## Internet

### TCP/IP

IP = Internet Protocol
IP V4 : #.#.#.# avec 0 < # < 255, soit 8 bits par nombre, 32 bits au total, environ 4 milliard de valeurs possibles.
On va petit à petit vers IPv6 128 bits.

L'équivalent d'une adresse postale, chaque équipement a une adresse unique.

TCP = Transmission Control Protocol
Permet de garantir l'envoi des packets, en fournissant une "sequence number". Si on envoie 10 packets, chacun sera numéroté 1/10, 2/10, 3/10 etc... Si l'un d'entre eux est perdu en route, le destinataire peut demander un nouvel envoi.

Port Numbers : Donne à l'ordinateur l'indication du type de programme qui doit ouvrir les packets.

Par exemple, 80 pour HTTP ou 443 pour HTTPS

DNS = Domain Name Servers
Fais le lien entre un nom de domaine et l'adresse IP d'un site.

DHCP = Dynamic Host Configuration Protocol
Configure les IP et les DNS de nos appareils quand on les démarre, ce qui était autrefois configuré à la main.

HTTP = Hyper Text Transfer Protocol
HTTPS = Secured

### URLs

### Get & Post

Pour aller sur le site de Harvard, on va taper `harvard.edu` dans notre navigateur. Ce dernier enverra une requête au serveur sous cette forme :

```
GET / HTTP/2
Host : www.harvard.edu
...
```

Le serveur enverra cette réponse :

```
HTTP/2 200
Content-Type : text/html
...
```

200 est un status code qui signifique "OK", que tout s'est bien passé.

```
200 OK
301 Moved Permanently
302 Found
304 Not Modified
307 Temporary Redirect
401 Unauthorized
403 Forbidden
404 Not Found
418 I'm a Teapot
500 Internal Server Error
503 Service Unavailable
...
```

## HTML

HTML est un mark up langage, pas de fonctions, pas de loops etc.. Mais permet de présenter de l'information.

Ne pas faire confiance "client-side", car l'HTML peut être modifié grâce aux outils de dev des navigateurs.

validator.w3.org permet de vérifier que notre HTML est correct au niveau de la syntaxe.

### Balises HTML

- `<h(n)></h(n)>` : Titre (1 < n < 6)
- `<p></p>` : Paragraphe
- `</br>` : Saut de ligne
- `<a></a>` : Lien

**Liste**

- `<ul></ul>` : Liste non-ordonnée
- `<ol></ol>` : Liste ordonnée
- `<li></li>` : Element de liste

**Tableau**

- `<table></table>` : Tableau
- `<tr></tr>` : Table Row
- `<thead></thead>` : En-Tête
- `<th></th>` : En-Tête du tableau
- `<tbody></tbody>` : Corps du tableau
- `<td></td>` : Cellule du tableau

**Mise en page**

- `<div></div>` : Division de block
- `<span></span>` : Division pour manipulation CSS
- `<header></header>` : En-tête de section
- `<footer></footer>` : Pied de page
- `<nav></nav>` : Menu de navigation
- `<section></section>` : Division pour manipulation CSS

**SEO**

- `<time></time>` : Date, on la passe en format américain (YYYY-MM-DD) avec le paramètre `datetime`
- `<abbr></abbr>` : Abbréviation, permet de révéler le mot complet au passage de la souris.
- `<aside></aside>` : Contenu peu utile à la page
- `<strong></strong>` : Contenu important de la page
- `<dfn></dfn>` : Définition d'un mot
- `<article></article>`Pour les articles de blogs

**Visuel**

- `<hr>` : Créer une ligne de séparation
- `<code></code>` : Ecrire du code
- `<blockquote></blockquote>` : Citation
- `<cite></cite>` : Citation
- `<q></q>`: Citation courte
- `<small></small>` : Texte à taille réduite
- `<mark></mark>` : Texte surligné
- `<del></del>` : Texte barré (supprimé) -`<sub></sub>` : Texte en indice (H<sub>2</sub>O)
- `<sup></sup>` : Texte en exposant (a<sup>2</sup> + b<sup>2</sup> = c<sup>2</sup>)
- `<u></u>` : Texte souligné
- `<i></i>` : Texte en italique
- `<fieldset></fieldset>` : Permet de créer un cadre pour du contenu
- `<legend></legend>` : Dans un fieldset, sera disposé sur le cadre
- `<progress></progress>` : Barre de progression
- `<meter></meter>` : Barre de progression
- `<details></details>` Permet de créer un "spoiler"
- `<summary></summary>`: Ce qu'on voit avant de cliquer sur le spoiler
- `<dialog></dialog>` : Fenêtre de dialogue
- `<figure></figure>`: Association d'image et de sa légende
- `<picture></picture>`: Image en fonction d'un paramètre
- `<figcaption></figcaption>` : Légende de l'image dans la figure
- `<kbd></kbd>` : Aspect touche de clavier
- `<var></var>` : Mettre en avant une variable dans du code, ou une équation

**Multimédia**

- `<img>` : Image
- `<audio></audio>` : Audio
- `<video></video>` : Vidéo
- `<iframe></iframe>` : Autre page d'un site dans notre page
- `<svg></svg>` : Formes vectorielles
- `<canvas></canvas>` : Permet de dessiner en JS
- `<embed>` : Fichiers DOC, PDF...

**Formulaire**

- `<label></label>` : Ecrire
- `<input></input>` : Variétés d'inputs à entrer par l'utilisateur (RegEx intégrée ?)
- `<button></button>` : Bouton pour submit
- `<textarea></textarea>` : Zone de texte (On peut définir sa taile grâce aux paramètres `rows` et `cols`)

**Différents inputs**
Grâce au paramètre `type`, on peut venir créer tout un tas d'inputs différents :

- `text`
- `password`
- `email`
- `number`
- `tel`
- `date`
- `time`
- `url`
- `checkbox` : Case à cocher
- `radio` : Sélection
- `range` : Slider
- `select (option)` : Liste déroulante
- `textarea`
- `submit`

## CSS Best Practices

### Penser en boites (Content, Padding, Border, Margin)

Par défaut, le CSS est pensé en `content-box`, on préfère le configurer en `border-box` pour inclure le padding et la marge.

Il faut penser nos boîtes horizontalement, car une nouvelle `div` nous permettra d'ajouter du contenu verticalement.

Les boites ont des relations de parent-enfant, et le CSS est pensé en cascade, donc les attributs des parents sont automatiquement donnés aux enfants à moins d'être overwrités.

### Flexbox

Il faut utiliser flexbox à la place de `absolute-positioning`, ce qui simplifie largement le responsive en fonction de la taille de l'écran, et qui permet d'ajuster facilement le layout en cas d'ajout ou de suppression d'élément.

Ces trois propriétés sont les plus importantes :

```CSS
diplay;
justify-content;
align-items;
```

D'autres propriétés cool :

```CSS
flex-grow;
```

### Grid

Pour les éléments qu'on souhaite afficher sur deux dimensions, c'est `display:"grid";` qui est le plus adapté.

#### Niveau : Facile

Si tous nos éléments font la même taille, on utilise la propriété `gridTemplateColumns` avec l'attribut `auto-fill` sur le parent.

```CSS
gridTemplateColumns= repeat(auto-fill, taille)
```

#### Niveau : Intermédiaire

Pour utiliser facilement grid, il faut choisir notre plus petite unité de taille. Un exemple commun serait de diviser notre canva en 12, qui est divisible par 2, 3, 4 et 6. Cela nous permettra de faire des lignes de 2, 3, 4 ou 6 éléments.

Si nos éléments sont tous alignés horizontalement, c'est facile. Pour définir notre grid, on va sur l'élément parent, et on utilise les propriétés suivantes :

```CSS
display:"grid";
gridTemplateColumns:"repeat(12, 1fr)";
gridAutoRows: (taille en px);
gap: (taille en px);
```

Puis, pour chacun de nos enfants, on vient définir les paramètres `gridColumn` et `gridRow`, en utilisant `span` pour définir leur taille en terme d'unités.

```CSS
gridColumn="span 8";
gridRow="span 2";
```

#### Niveau : Complexe

Enfin, si on souhaite que nos éléments aient des hauteurs différentes au sein d'une même ligne, c'est un peu plus complexe. On va utiliser un paramètre appelé `gridTemplateAreas`. On va ensuite créer une constante qui contiendra une matrice, qui nous permettra de définir la taille de nos objets :

```CSS
gridTemplateAreas="constante";
```

```CSS
const constante = '
"a b c"
"a b c"
"a b c"
"a b f"
"d e f"
"d e f"
"d h i"
"g h i"
"g h j"
"g h j"
'
```

On vient ensuite définir la propriété `gridArea` de chaque boîte.

```CSS
gridArea="a";
```

La constante ci-dessus nous donnera ce layout :

![AltText](https://github.com/iMaisho/perso/blob/main/Ressources/Images/gridArea.png?raw=true)

### Media-queries

Les media-queries nous permettent de changer le comportement de nos éléments en fonction de la taille de l'écran.

Grâce aux techniques qu'on a vu plus tôt, la majorité de nos éléments seront naturellement responsive.

Cependant, si on souhaite que certains éléments qui étaient affichés en ligne se superposent en étant visionnés sur un téléphone, on peut simplement utiliser une media-query qui supprime le paramètre `display flex`. Nos éléments se superposeront naturellement.

### Absolute/Relative positionning

Devrait être utilisé quand on a vraiment pas le choix, car beaucoup plus galère à rendre responsive et à modifier.

Une façon très commune de les utiliser, c'est quand on souhaite superposer deux éléments, par exemple un bouton sur une photo.

On vient donner la propriété `position="relative";` à notre parent, puis on donne la propriété `position="absolute";` à l'enfant que l'on souhaite superposer, en jouant avec les paramètres `bottom`, `top`, `left` ou `right` en fonction de l'endroit où l'on souhaite le positionner.
