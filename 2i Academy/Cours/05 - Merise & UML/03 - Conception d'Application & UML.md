
# Conception de l'IHM (Interface Homme-Machine = GUI)

## Zoning

On dessine les zones que contiendra notre application. Pour cela on utilise de préférence un logiciel de dessin vectoriel. (Inkscape, draw.io pour les logiciels gratuits)

Puis on précise nos éléments en faisant une maquette. (penpot, draw.io, mydraft, pencil)

On peut également le faire sur papier.

## Modélisation

Représentation abstraite de la réalité.

C'est un outil de communication pour être certains que tous les partis liés au projet soient sur la même page, pour éviter les flous artistiques.

Par exemple, un plan d'architecte ou un modèle mathématique pour représenter un phénomène.

Une modélisation peut être :

- **Descriptive** : le modèle décrit une réalité *existante*
- **Prescriptive** : le modèle décrit une réalité *espérée*
- **Prospective** : le modèle décrit une évolution *future*

Dans tous les cas, le modèle est une simplification de la réalité. Il n'est pas la réalité qu'elle tente de décrire.

Il faut qu'il y ait une intention derrière la création d'un modèle. S'il n'y en a pas ou plusieurs, peut être qu'il n'est pas nécessaire ou qu'il faudrait en faire plusieurs plus simples.

Pourquoi modéliser ?

- Fabriquer un modèle est un **outil de réflexion,** qui nous permet de se poser des questions et de prévoir.
- Le modèle est un **outil de communication et de contrôle** dans des équipes où tout le monde n'a pas les mêmes compétences.

L'analogie avec l'architecture est utile, mais pas 100% vraie car dans le cadre d'un projet informatique, on peut être amené à retravailler sur les fondations, où à ajouter "un étage au milieu d'un immeuble"

**Design pattern** : Solution généraliste à un problème récurrent

*Design patterns : Catalogue des modèles de conception réutilisables - Gang of Four*

# UML (Unified Modeling Language)

Formalisme graphique pour décrire les composants d'un système, leurs associations et leurs interactions

Méthode de conception qui consiste en la création de 15 types de diagrammes pour clarifier différents aspects de l'application.

On va en apprendre 5 ici.

Les diagrammes UML sont divisés en deux catégories
- les diagrammes **de structure (ou statique)** qui décrivent un logiciel hors utilisation
- les diagrammes **de comportement (ou dynamique)** qui décrivent les séquences et intéractions entre les éléments lors de l'utilisation du logiciel

Les outils : Visual Paradigm Online, Star UML, Visual Paradigm CE

## Diagramme de cas d'utilisation

Il décrit les fonctionnalités d'un système du point de vue de l'utilisateur, sans aller dans le détail du fonctionnement en interne.

Il s'agit d'un diagramme assez simple, pouvant être compris par tous.

Il permet de :
- Visualiser le périmètre fonctionnel du système
- Identifier les acteurs et les rôles
- Identifier les dépendances entre les fonctionnalités
- Plannifier le travail à réaliser 

En général on place à gauche l'utilisateur actif, et à droite les entités ou autres systèmes réactifs, qui réagissent à l'action de l'utilisateur.

### Include

On place un cas d'utilisation nécéssaire et obligatoire au cas d'utilisation général en le reliant avec une flèche pointillée annotée "include"

Le cas inclus se déroule obligatoirement lorsque le cas hôte est invoqué. Par exemple il est nécessaire de vérifier le code PIN pour retirer de l'argent

### Extend

Un cas peut se jouer de façon optionnelle lorsqu'un autre cas est invoqué; Par exemple le client peut demander l'impression d'un ticket

### Spécialisation des cas ou des acteurs

Flèche pleine de l'objet spécialisé vers l'objet généralisé, qui indique une relation d'héritage.

### Guidelines

- Faire **simple**
- Avoir une **intention**
- Ne pas hésiter à faire **plusieurs diagrammes**
- Trouver le **niveau de détail pertinent**
- Utiliser des **verbes explicites** qui indiquent l'action (donc éviter les verbes faire, avoir, être..)
- Utiliser le vocabulaire voire **le jargon du métier** ex : "retirer des devises" plutôt que "prendre des sous"
- Placer **les cas les plus importants en haut à gauche** du diagramme
- **Nommer les acteurs de façon précise** et en utilisant si possible le champ sémantique du domaine, privilégier un nom **qui indique le rôle plutôt que la nature de l'acteur**
- **Les acteurs n'ont pas d'interactions entre eux,** ils n'interagissent qu'avec les cas
- Pour représenter un cas planifié **on peut utiliser un acteur nommé chrono ou temps**

### Conclusion

Ce diagramme aura l'avantage de servir de suivi de l'avancement du projet, et permettra d'arbitrer les différents cas d'usage à prioriser, en fonction de leur valeur et de leur risque.

Grâce aux cas d'utilisation :
- Le client sait ce que fera son logiciel
- Le développeur sait ce qu'il va devoir produire
- On évite les malentendus, les oublis et les conflits


## Diagramme d'activités

Ce diagramme fait partie de la famille des diagrammes dynamiques. Il s'agit d'une illustration algorythmique d'un cas d'usage. 

Ce diagramme se concentre sur le flux des données.

On peut l'utiliser pour : 
- Représenter les étapes d'un algorithme
- Représenter tout ou partie du scénario d'un cas d'utilisation
- Représenter les étapes d'un process métier (pas forcément informatisé)
- Représenter le plan de navigation d'un site web(pas prévu dans UML mais préconisé par Pascal Roques)

## Diagramme de classe

Ce diagramme peut permettre de : 
- décrire l'architecture **statique** d'une application orientée objet.
- représenter une structure de données, d'ailleurs dans Looping on peut convertir nos MCD en UML.
- décrire un design pattern

Type de classes
- Classes métiers dans des applications complexes
- Contrôleurs
- Value Objects (Classe qui contient de la data)

Anatomie d'une classe en UML :
- Nom de la classe en PascalCase
- Liste des propriétés (attributes) avec leur nom en camelCase, le type de données et leur portée ('-' = privé, '+' = public, '#' = protected (portée dépendante du langage), '~' = privé au niveau du package)
- Liste des méthodes (operations) de la classe avec leur nom en camelCase, leur type de retour et le nom et type de leurs arguments


Portée des données ne concerne que l'implémentation dans l'application et n'a pas de lien avec sa visibilité dans l'application. Une portée privée oblige à utiliser des méthodes de getter et setter pour accéder aux données, ce qui est plus sécurisé. Cela s'appelle l'encapsulation, par défaut c'est l'objet qui traite ses données, et si on ne définit pas de getter/setter, les données sont innaccessibles.

### Communication entre des classes

Du fait du principe d'encapsulation, pour que deux classes communiquent il faut qu'une instance de la classe A soit contenue dans la classe B.

**Composition** = Couplage fort : A la création d'une instance, je dois créer les instances de ses éléments.

**Agrégation** = Couplage faible : Les deux classes ont un lien réel, mais peuvent exister l'une sans l'autre.

**Dépendance** = Couplage temporaire : la classe dépendante ne stocke pas durablement l'instance dont elle dépend, car elle n'est appelée que dans les méthodes, et pas dans les propriétés de la classe.

**Héritage/Spécialisation/Generalisation** : La classe enfant hérite des propriétés et des méthodes des parents, donc ce lien est intéressant car on peut créer une nouvelle spécialisation sans avoir à modifier les méthodes qui intéragissent avec la classe parent.

### Classe abstraite

Classe qui ne peut pas être instanciée. Elle ne peut être utilisée que si d'autres classes héritent de ses propriétés et méthodes. C'est un genre de moule qui contient un code générique à partir duquel seront créées des spécialisations qui doivent utiliser ce code.

### Interface

Une interface est un objet qui définit des méthodes, sans contenir de code. Les méthodes seront implémentées directement dans les classes liées à cette interface, l'interface est simplement un indicateur visuel, un contrat, de la présence de ces méthodes dans une classe qui lui est liée. Ces méthodes sont également typées et spécifiées pour cette classe.

Le premier exemple est trop précis, car les méthodes sont basées sur Person, donc un autre DAO ne pourrait pas appeler les mêmes méthodes. 

On utilise donc **un type générique**, ici appelé T, puis on vient préciser dans notre classe la valeur de ce type générique. On attend l'implémentation avant de typer.

DAO : Data Access Object

Ce diagramme est le seul diagramme UML qui permet la génération de code automatique avec des outils professionnels payants.

### Observer

https://refactoring.guru/fr/design-patterns/observer

### Decorator

Un decorator permet d'aller ajouter des arguments à une classe sans la modifier.

https://refactoring.guru/fr/design-patterns/decorator

## Diagramme de séquence

Ce diagramme **dynamique** illustre les interactions des acteurs d'un système en se concentrant sur l'ordre des messages échangés.

Il en existe deux types :

Le diagramme de séquence système :
- Donne une vue d'ensemble des interactions entre les acteurs d'un système, le nombre d'acteurs est limité et ils ne sont pas typés

Le diagramme de séquence détaillé :
- Détaille les interactions entre des composants d'un système voire entre des objets. Dans ce dernier cas les messages sont souvent des appels de méthodes et les instances sont typées par leur classe. Il est souvent utilisé pour illustrer tout ou partie d'un cas d'utilisation


## Diagramme d'états-transitions (Statechart)

Ce diagramme illustre les différents états d'un système, d'un objet ou d'une variable ainsi que les conditions du passage d'un état à l'autre.

C'est un diagramme assez simple, qui relie les états avec des transitions.

On peut utiliser ce diagramme pour dessiner la navigation d'un site web.

## Diagramme de déploiement

Le diagramme de déploiement est un diagramme statique qui décrit l'infrastructure technique d'exécution d'une application et de la distribution des composants et des artéfacts entre les différents noeuds de cette architecture.





