<?php

$recipes = [
    ["Carbonara","Contenu de la recette", "Utilisateur 1", true,],
    ["Sorbet au Citron","Contenu de la recette", "Utilisateur 2", true,],
    ["Lessive Maison","Contenu de la recette", "Utilisateur 3", true,],
    ["Frites Surgelées au Four","Contenu de la recette", "Utilisateur 4", true,],
]
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Exercice P2C3</title>
    </head>

    <body>
    <h1>Bienvenue sur recettes.com</h1>
    <?php
        for ($recipeId = 0; $recipeId <= 3; $recipeId++)
        {
            echo $recipes[$recipeId][0] . ' - ' . $recipes[$recipeId][2] . '<br />';
        };
    ?>
    </body>
</html>
