<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>

<style>
    .error {
        padding: 10px;
        background: red;
        color: white;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
    <main class="container" style="padding: 10px">
        <nav>

            <ul>
                <li>
                    Bonjour <?= getUserName() ?>
                </li>
            </ul>

            <ul>
                <li><a href="/accueil">Accueil</a></li>
                <li><a href="/inscription">Inscription</a></li>
                <li><a href="/connexion">Connexion</a></li>
            </ul>
        </nav>

        <!-- Affichage des erreurs -->
        <?php if(isset($errors) && count($errors) > 0): ?>
        <div class="error">
            <?=implode("<br>", $errors)?>
        </div>
        <?php endif; ?>

        <?php  include $contentView ?>
    </main>
</body>
</html>