# PHP

## Serveur Web Local PHP

On peut utiliser Apache, Nginx ou Docker pour créer des serveurs locaux, mais PHP permet également de le faire en natif. L'avantage est qu'on peut placer notre projet n'importe où dans notre arborescence PC (et pas forcément dans le dossier htdocs par exemple)

Pour cela on utilise la commande 

```shell
php -S localhost:8000
# On peut ajouter un chemin absolu ou relatif en utilisant -t
# localhost peut être remplacée par l'IP d'une autre machine
# le port 8000 est un choix cohérent car pas utilisé par défaut, mais on peut utiliser n'importe quel port
```

## Introduction

Une variable est déclarée avec un symbole $

- Indirection : En mettant plusieurs $, on peut appeler une variable qui porte le nom du contenu d'une autre variable, afin de s'adapter à un contexte

```php
<?php
$name = "bob";
$bob = 5;

echo $$name;
#Equivaut à echo $bob = affichera 5
?>
```

En PHP, l'opérateur de concaténation historique et par défaut est le point `.`

Dans le cas particulier de `echo`, la virgule `,` est également un opérateur de concaténation.

L'interpolation ne fonctionne qu'en utilisant les doubles-guillements `"`

Du coup, en orienté Objet, le `.` ne peut pas être utilisé pour séparer un objet et sa méthode, c'est la flèche `->` qui a été choisie pour palier ce problème.

- Les sessions permettent de conserver un état de requête en requête (par exemple, l'état loggé)

- Astuce : Dans un formulaire, on peut séparer les données facilement en utilisant un nom de tableau dans l'attribut "name" (voir PHP-intro p.40-43)

Cela peut également nous permettre de récupérer une liste de taille variable de valeurs (voir PHP-intro p.50-52S)

Best practices : Placer nos traitements php en haut du fichier, puis l'HTML en dessous.

```php
<?= "XXX" ?>
// Est équivalent à 
<?php echo "XXX"; ?>
// Mais on ne peut écrire qu'une instruction (donc pas besoin du point virgule)
```

Le site `phpdocker.io` permet de générer des fichiers composer pour Docker en choisissant des extensions de PHP.

## Include / Require

``Require`` qui fait planter en cas de bug est mieux que ``Include`` qui affiche une erreur en cas de bug car en général notre logiciel ne fonctionnera pas si l'include s'est mal passé. En revanche il est un peu moins performant.

``Once`` peut être utile quand on utilise des bibliothèques qui utilisent elles même des bibliothèques, car un fichier appelé deux fois fera planter le logiciel


## En-têtes HTTP

Une requête HTTP est constituée d'une en-tête et d'un corps

L'en-tête transmet le contexte.

Par exemple, cela permet d'effectuer une redirection :

```php
header("location:$path");
```

De forcer un type de contenu :

```php
header('Content-Type: application/json');
$user = array(
    'name' => 'Maloron',
    'lastname' => 'Sébastien',
    'age' => 87
);
echo json_encode($user);
```

De forcer le téléchargement 

```php
$fileName = 'participants.csv';

header("Content-type:application/csv");
// filename permet de suggérer un nom de fichier

header("Content-Disposition:attachment;filename='$fileName'");
// Affichage du contenu

echo "nom;age\n";
echo "Pierre;20\n";
echo "Jean;32\n";
echo "Odile;40\n";
```

## Docker App

On a un système de fichier local, et un système de fichier virtualisés dans docker.
Du coup on a un système de mapping (pour chaque outil de notre application d'ailleurs)

```yml
        volumes:
            - './app:/application'
```

Cette ligne map le dossier `app` en local au dossier `application` virtuel.

### nginx

Comme on veut coder notre application comme un chateau fort, on ne veut qu'une porte d'entrée, en l'occurence `index.php`

Cependant, si on reroutait toutes nos requêtes sur index.php, on ne pourrait pas utiliser de fichiers CSS ou d'images par exemple.

On ajoute donc ce paramètre dans le fichier de configuration d'nginx

```conf
    # try to serve file directly, fallback to index.php
    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }
```

Il va tester si la route existe, sinon il redirige vers index.php

## Rerouting

```php
// Récupère la route dans GET, si n'existe pas, remplace par /home
$route = filter_input(INPUT_GET, "route") ?? "/home";

switch($route){
    case "/home":
        $controller = "home.php";
        break;
    default:
        $controller = "not-found.php";
}

require CONTROLLER_PATH . $controller;
```

## PDO

prepare : Le moteur connait les informations de la requête, sauf les paramètres qu'on a pas encore passé. Cela permet de se prémunir des injections SQL, et d'optimiser le temps de calcul si on souhaite utiliser la même requête plusieurs fois.