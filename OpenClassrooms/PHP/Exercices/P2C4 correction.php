<?php

$recipes = [
    ["title" => "Carbonara",
    "content" => "Contenu de la recette", 
    "author" => "Utilisateur 1", 
    "is_enabled" => true],
    ["title" => "Sorbet au Citron",
    "content" => "Contenu de la recette", 
    "author" => "Utilisateur 2", 
    "is_enabled" => true],
    ["title" => "Lessive Maison",
    "content" => "Contenu de la recette", 
    "author" => "Utilisateur 3", 
    "is_enabled" => false],
    ["title" => "Frites Surgelées au four",
    "content" => "Contenu de la recette", 
    "author" => "Utilisateur 4", 
    "is_enabled" => true],
]
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Exercice P2C4</title>
    </head>

    <body>
    <h1>Bienvenue sur recettes.com</h1>
    <?php foreach ($recipes as $recipe): 
        if (array_key_exists('is_enabled', $recipe) && $recipe["is_enabled"]): ?>
        <h2><?php echo $recipe["title"] ?></h2>
        <p>
            <?php echo $recipe["content"] ?> <br>
        <i>
            <?php echo $recipe["author"] ?>
        </i>
        </p>
        <?php endif ?>
    <?php endforeach ?>
    </body>
</html>
