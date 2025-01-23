<?php 
    require_once(__DIR__ . "/variables.php"); 
    require_once(__DIR__ . "/functions.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recettes de cuisine : </title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

    <?php require_once(__DIR__ . "/header.php"); ?>

    <div class="container">
        <h1>Liste des recettes de cuisine</h1>

        <?php foreach (getRecipes($recipes) as $recipe) : ?>
            <article>
                <h3><?php echo($recipe['title']); ?></h3>
                <div><?php echo($recipe['recipe']); ?></div>
                <i><?php echo(displayAuthor($recipe['author'], $users)); ?></i>
            </article>
        <?php endforeach ?>
    </div>

    <?php require_once(__DIR__ . "/footer.php"); ?>
</body>

</html>

