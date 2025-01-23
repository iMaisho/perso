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