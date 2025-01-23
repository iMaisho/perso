<?php
$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => 'Etape 1 : des flageolets !',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => 'Etape 1 : de la semoule',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => 'Etape 1 : prenez une belle escalope',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
];


$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'mickael.andrieu@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
    ],
];

function isValidRecipe($recipe) : bool
{
        if(array_key_exists("is_enabled", $recipe) && $recipe["is_enabled"]){
            $isEnabled = true;
        }
            
        else{
            $isEnabled = false;
        }
        
        return $isEnabled;
}


function getRecipes($recipes) : array
{
    $validRecipes = [];

    foreach($recipes as $recipe){
        if (isValidRecipe($recipe)){
            $validRecipes[] = $recipe;
        }
    }
    return $validRecipes;
}

function displayAuthor($recipe, $users) : string
{
    foreach ($users as $user){
        if ($user["email"] === $recipe["author"]){
            return  $user["full_name"] . " (" . $user["age"] . "ans)";
        }
    }
}
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
    <?php 
    foreach (getRecipes($recipes) as $recipe): ?>
        <h2><?php echo $recipe["title"] ?></h2>
        <p><i>
            <?php echo displayAuthor($recipe, $users)  ?>
        </i></p>
    <?php endforeach; ?>
    </body>
</html>
