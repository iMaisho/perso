# Qu'est ce qu'un objet ?

Une structure de données possédant :
    - Des propriétés
    - Un état (valeurs des propriétés)
    - Des méthodes (fonctions) qui permettent d'intéragit avec les propriétés

C'est l'encapsulation : On regroupe les données et leurs méthodes. L'intérêt étant qu'on a moins d'arguments à donner à nos méthodes, car leur contexte est apportée par l'objet qui les contient.

## Une classe

La classe est un moule qui va permettre d'instancier des objets dans un état initial qui lui sera propre.

On déclare d'abord les propriétés, puis le constructeur, puis le reste des méthodes.

IMPORTANT : Savoir manipuler les tableaux avec array-filter, MAP etc... Très important en JS mais existe dans tous les languages orientés objet.

## Syntaxe alternative pour constructeur

```php
<?php
class Color
    {
        public function __construct
            (
            private int $red,
            private int $green,
            private int $blue
            )
        {}
    }
```

Cette syntaxe permet d'éviter d'avoir à définir les propriétés en dehors du constructeur puis de leur assigner une valeur, tout est fait en une seule étape.

Un constructeur sers quand on veut créer un objet en définissant tout ou partie de ses propriétés.

#  3 grands principes

## Encapsulation

- Restreindre l'accès aux propriétés et méthodes
- Protéger l'intégrité des données
- Définir une interface publique et masquer la mécanique interne 

(exemple: le poste radio, mêmes contrôles pour une radio analogique et une radio numérique pour ne pas perdre les utilisateurs, pourtant à l'intérieur tout a changé)

Cela implique que l'interface à laquelle a accès le reste de l'application doit rester stable, donc être pensée en amont pour éviter de tout casser si on la change.

### Niveaux de visibilité

- public (accessible à toute le monde)
- protected (accessible à la classe et à ses enfants)
- private (accessible uniquement à la classe)

## Héritage

On peut imaginer une classe générale, et des spécialisations (enfants) de cette classe, avec des propriétés et des méthodes supplémentaires.

```php
class Employee extends Person {
    ...
}
```

On ne peut hériter que d'une classe, de ses propriétés et ses méthodes.

On peut redéfinir la méthode d'un parent, en utilisant le même nom et la même signature.


## Polymorphisme (p.21)

```php
abstract class Shape
{
    public abstract function calculateArea();
}
```
Shape est une classe abstraite qui ne contient qu'une méthode abstraite. Elle ne peut pas être instanciée.

Cependant elle a son utilité car elle forcera tous ses enfants à intégrer cette méthode et à l'implémenter, spécifiquement en fonction du type de forme. Par exemple pour le carré : 

```php
class Square extends Shape
{
    public function __construct(
        private int $side
    ){}
    public function calculateArea(){
        return $this->side * $this->side;
    }
}
```



On pourrait utiliser une interface à la place.


# Méthodes magiques

Une méthode magique se repère car son nom commence par deux underscores.

La méthode magique que l'on connait pour l'instant est le constructeur `__construct`, qui permet de définir les propriétés d'une classe

```php
public function __construct(
        protected string $label,
        protected string $name,
        protected string $type = "text",
        protected string $value = ""
    ){}
```

Il existe les méthodes `__set` `__get` et `__call` mais elles ne sont pas particulièrement pertinentes.

La méthode `__tostring` permet de retourner une string lorsqu'on tente de print un objet. On peut choisir ce qu'on retourne, mais une utilisation classique est de retourner la valeur de la méthode `render`, ce qui permet d'afficher notre objet avec un simple `echo`

```php
// Retourne une erreur car l'instance de notre objet n'est pas une chaîne de caractères
echo $field;
```
```php
    public function __toString(): string{
        return $this->render;
    }

//Retourne le render de notre objet
echo $field;
```

# Propriétés et méthodes statiques

- Une propriété ou une méthode d'une classe qui n'a pas besoin d'instance
- Dans le cas d'une propriété, la valeur est donc la même pour toutes les instances
- Ne pas abuser des méthodes statiques

Par exemple, dans le cas de nos FormFields, on pourrait avoir un tableau des types de champs, pour pouvoir vérifier qu'ils sont corrects en HTML.

Tous nos FormFields auront accès à la même propriété avec la même valeur, donc autant la définir dans la classe.

## Cas d'usage : Pattern singleton

```php
class DBConnection
{
    private static PDO $connection;

    public static function getConnection(): PDO {
    if (!self::$connection) {
        self::$connection = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
        }
        return self::$connection;
    }
}
```

Cette classe utilise le pattern Singleton pour toujours retourner la même instance de PDO.

Pour appeler une méthode statique, on utilise cette syntaxe :

```php
// include 'classes/DBConnection.php';
DBConnection::getConnection();
```

## Désavantages

- Couplage fort, forte dépendance des classes utilisatrices
- Peu de flexibilité, incompatible avec le principe open/close (ouvert à l'extension, fermé à la modification)
- Les dépendances ne sont pas évidentes (il faut lire tout le code pour les repérer)
- Difficile de faire du test unitaire de classes si elles dépendent de méthodes statiques
- Les propriétés statiques sont globales, elles peuvent provoquer des effets de bord
- On ne fait plus de l'orienté objet, mais du procédural déguisé en objet

## Constante de classe

C'est comme une propriété statique, sauf qu'on ne peut pas la modifier. Elle est forcément publique.

```php
class Circle {
    const float PI = 3.14159;
    public function calculateArea(float $radius): float {
        return self::PI * $radius**2;
    }
}
```

# Interface

- Un contrat qui détermine des méthodes et/ou des propriétés qu'une classe doit implémenter
- La classe doit respecter la signature des méthodes de ses interfaces
- Une classe peut implémenter plusieurs interfaces
- On peut (doit) typer sur une interface

Voir PHP-objet p.32-33

## Avantages

- On peut ajouter un nouveau type de champ sans avoir à modifier le code existant
- On peut ajouter une nouvelle règle de validation
- Tant que les nouvelles classes respectent les interfaces requises elles sont utilisables

# Classe Abstraite

- Similaire aux interfaces mais peuvent contenir des implémentations
- Les classes abstraites ne peuvent être instanciées

## Intérêt

- La classe abstraite permet de partager du code générique
- Elle peut se substituer à une interface
- Les classes concrètes spécialisent la classe abstraite et peuvent parfois simplifier son interface publique

# Les traits

- Partage de code entre des classes sans passer par l'héritage
- Spécificité de PHP
- Peut contenir des propriétés et des méthodes
- Se comporte comme un copier/coller

# Auto-chargement des classes :

```php
spl_autoload_register(function($class_name) {
    $file = __DIR__ . '/classes/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
```

Si notre architecture de fichier est bien fait, c'est à dire qu'on a une classe par fichier et que le fichier porte le nom de la classe, on peut utiliser cet outil pour charger automatiquement les classes à chaque instanciation.

On ne l'utilise que quand on utilise pas `Composer` (c'est rare) car il a son propre autoloader et que ça induirait des complexités d'avoir deux types d'auto-loaders en simultané.

# Les exceptions

Sépare la gestion des erreurs du code qui provoque l'erreur, ce qui permet de :
- Différer la gestion des erreurs
- Permettre un traitement des erreurs différencié
- Simplifier le code en séparant les responsabilités

On peut créer ses propres exceptions.

Tableau des exceptions p.50

# Composer

- **Gestion des dépendances** : Composer télécharge et installe automatiquement les bibliothèques PHP requises pour un projet.
- **Versionning** : Il permet de spécifier les versions exactes des dépendances nécessaires, assurant ainsi la compatibilité entre les différents composants.
- **Autochargement** : Composer offre la possibilité aux paquets d'enregistrer un autochargeur, facilitant l'utilisation des classes dans le projet.

On peut installer simplement des librairies.

# Namespaces

Répertoires virtuels qui facilitent les points suivants :

- **Organisation du code** : Ils permettent de structurer le code de manière logique, similaire à une arborescence de dossiers.
- **Évitement des conflits** : Ils résolvent les problèmes de noms identiques entre différentes parties du code ou bibliothèques.
- **Autoloading** : Ils facilitent la mise en place d'un système d'autoloading des classes.
- **Lisibilité** : Ils améliorent la lisibilité du code en évitant les noms de classes trop longs ou préfixés.

L'intérêt est que quand on commence à travailler avec des bibliothèques externes, on a pas la main sur les dépendances ni une connaissance parfaite de ces bibliothèques.
Plutôt que d'utiliser des `require`, cela permet de mettre en place les autoloaders pour ne plus avoir à s'en soucier.

**LIRE SUR LES NAMESPACES**

# QueryBuilder

C'est une classe qui permet de rédiger des requêtes SQL

# Data Access Object (DAO)

Un DAO est un objet qui permet d'effectuer les méthodes CRUD sur les bases de données (Create, Read, Update, Delete). Il utilisera un pdo pour émettre les requêtes et un QueryBuilder pour écrire les requêtes.

On peut créer des enfants à ce DAO générique pour les spécialisations, par exemple pour l'authentification d'un utilisateur.