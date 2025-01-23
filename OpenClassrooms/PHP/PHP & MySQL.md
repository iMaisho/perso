# PHP & MySQL

https://www.php.net/manual/fr/index.php

## Syntaxe

`<?php ?>` = Balise PHP
`echo` = Ecrire du texte
`\` = Echapper le caractère suivant pour l'inclure dans la chaîne de caractère
`//` = Commentaire
`$variableName = "variableValue";` pour string
`$variableName = variableValue;` pour int, float, bool ou NULL
`==` = Est égal à, en valeur
`===` = Est strictement égal à, en valeur et en type
`!==` = Est différent de
`elseif` = Else if (J'avais vraiment besoin de l'expliquer..?)
`!` = Permet de vérifier qu'un booléen est faux, au lieu de vrai qui est le comportement par défaut.
`&&` = AND
`||` = OU
`=>` = Dans le cadre d'un DICT, "associé à"

## PHP

### Les guillemets

Pour écrire du texte sur notre page dynamique, on utilise `echo`.

```php
    echo "Bonjour et bienvenue sur le site !";
```

Pour intégrer une variable, on prévilégie les doubles guillements `""`, qui permettent d'interpoler notre variable grâce à des crochets `{}`

```php
    $fullname = "Mathieu Nebra";
    echo "Bonjour {$fullname} et bienvenue sur le site !";
```

Cependant on peut utiliser des guillemets simples `'` et utiliser la concaténation à la place, en séparant nos éléments par des points.

```php
 $fullname = 'Mathieu Nebra';
    echo 'Bonjour ' . $fullname . ' et bienvenue sur le site !'; // OK
```

En règle générale, on utilise l'interpolation lorsqu'on a besoin d'incorporer des variables directement dans une chaîne de caractères de manière propre et concise. C'est idéal pour rendre le code plus lisible.

En revanche, s'il y a des expressions complexes, des conditions ou des opérations à effectuer pendant la concaténation, alors la concaténation traditionnelle avec des guillemets simples reste une option solide. L'essentiel est de choisir l'approche qui rend le code le plus clair et le plus maintenable en fonction du contexte du projet.

### Conditions et Switch

Lorsqu'une condition posée est simple, on peut utiliser `if`, `elseif` et `else`.
Cependant lorsqu'elle est plus complexe, on préfère utiliser un switch, qui simplifie grandement la syntaxe.

```php
$grade = 10;

switch ($grade) // on indique sur quelle variable on travaille
{
    case 0: // dans le cas où $grade vaut 0
        echo "Il faudra revoir tout le cours !";
    break;

    case 5: // dans le cas où $grade vaut 5
        echo "Tu dois réviser plusieurs modules";
    break;

    case 7: // dans le cas où $grade vaut 7
        echo "Il te manque quelques révisions pour atteindre la moyenne ";
    break;

    case 10: // etc. etc.
        echo "Tu as pile poil la moyenne, c'est un peu juste…";
    break;

    case 12:
        echo "Tu es assez bon";
    break;

    case 16:
        echo "Tu te débrouilles très bien !";
    break;

    case 20:
        echo "Excellent travail, c'est parfait !";
    break;

    default:
        echo "Désolé, je n'ai pas de message à afficher pour cette note";
}
```

Attention cependant, **le switch ne peut tester que l'égalité**.

`break` permet de sortir du switch dès qu'on a trouvé la valeur correspondante.
`default` permet de définir le cas de base, si on a pas trouvé la valeur correspondante.

### Condenser les conditions : les ternaires

Dans le cas où on veut verifier qu'un utilisateur est majeur par exemple, on pourrait écrire :

```php
$userAge = 24;

if ($userAge >= 18) {
	$isAdult = true;
}
else {
	$isAdult = false;
}
```

Cependant on peut condenser cette condition en une ligne, dans ce cas précis on pourrait écrire :

```php
$isAdult = ($userAge >= 18);
```

Mais la syntaxe complète ressemble à ceci et sera adaptée à plus de cas:

```php
$isAdult = ($userAge >= 18) ? true : false;
```

Ces deux méthodes permettront, comme dans le cas initial d'assigner la valeur `true` à `$isAdult` si la valeur de `$userAge` est supérieure ou égale à 18.

### Arrays & Dicts

#### Créer un Array ou un Dict

Très similaire à Python

```php
$array = ["value0", "value1", ..., "valueN"]
```

```php
$dicts = ["key0" => "value0X",
        "key1" => "value1X",
        ..
        "keyN" => "valueNX"],

        ["key0" => "value0Y",
        "key1" => "value1Y",
        ..
        "keyN" => "valueNY"],

        ....

        ["key0" => "value0Z",
        "key1" => "value1Z",
        ..
        "keyN" => "valueNZ"]
```

#### La boucle `foreach`

La boucle foreach permet d'itérer sur chaque ligne de notre tableau ou dictionnaire, en créant une variable et en lui associant une nouvelle valeur pour chaque passage de ligne.

```php
foreach ($array as $variable) {
    echo $variable;
}
```

```php
foreach ($dicts as $array) {
    echo $variable["key0"];
}
```

_En python, l'expression équivalente était :_

```python
for dict in dicts{
    print dict["key0"];
}
```

On peut également utiliser `foreach` pour récupérer les clés de notre dict

```php
foreach ($dicts[$id] as $key => $value){
    echo '[' . $key / '] a la valeur ' . $value;
}
```

##### **Bonus :**

J'ai créé ce snippet de code pour itérer dans les différents tableaux d'un dictionnaire, afin de générer une liste de toutes les clés et leurs valeurs pour chacun des 4 tableaux.

```php
    <?php for ($id = 0; $id <= 3; $id++): ?>
        <ul>
        <?php foreach ($recipes[$id] as $key => $value): ?>
            <li><?php echo '[' . $key . '] a la valeur ' . $value; ?> </li>
        <?php endforeach ?>
        </ul>
        <br>
    <?php endfor ?>
```

Ce qui a pour effet de générer ce code HTML :

```html
<ul>
  <li>[title] a la valeur Carbonara</li>
  <li>[content] a la valeur Contenu de la recette</li>
  <li>[author] a la valeur Utilisateur 1</li>
  <li>[is_enabled] a la valeur 1</li>
</ul>
<br />
<ul>
  <li>[title] a la valeur Sorbet au Citron</li>
  <li>[content] a la valeur Contenu de la recette</li>
  <li>[author] a la valeur Utilisateur 2</li>
  <li>[is_enabled] a la valeur 1</li>
</ul>
<br />
<ul>
  <li>[title] a la valeur Lessive Maison</li>
  <li>[content] a la valeur Contenu de la recette</li>
  <li>[author] a la valeur Utilisateur 3</li>
  <li>[is_enabled] a la valeur 1</li>
</ul>
<br />
<ul>
  <li>[title] a la valeur Frites Surgelées au four</li>
  <li>[content] a la valeur Contenu de la recette</li>
  <li>[author] a la valeur Utilisateur 4</li>
  <li>[is_enabled] a la valeur 1</li>
</ul>
<br />
```

#### La fonction print_r

Cette fonction permet d'afficher rapidement le contenu d'un tableau pour le débugage, mais n'est pas utilisée directement dans l'affichage d'un site web. C'est pour cela qu'elle nécessite l'utilisation de la balise `<pre>`, qui affiche le texte tel qu'il est préformaté dans le code HTML, pour s'afficher correctement.

```php
<?php

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
];

echo '<pre>';
print_r($recipes);
echo '</pre>';
?>
```

#### Rechercher dans un array

`array_key_exists` pour vérifier si une clé existe dans le tableau.

```php
<?php array_key_exists('key', $array); ?>
```

Cette fonction retourne un booléen, et peut donc être utilisé dans des conditions if.

<br>

`in_array` pour vérifier si une valeur existe dans le tableau.

```php
<?php in_array('value', $array); ?>
```

Cette fonction retourne également un booléen, et peut donc être utilisé dans des conditions if.

<br>

`array_search` pour récupérer la clé d'une valeur dans le tableau.

```php
<?php
$users = [
    'Mathieu Nebra',
    'Mickaël Andrieu',
    'Laurène Castor',
];

$positionMathieu = array_search('Mathieu Nebra', $users);
echo $positionMathieu;
// retourne 0

$positionLaurène = array_search('Laurène Castor', $users);
echo $positionLaurène;
// retourne 2
?>
```

Cette fonction retourne `false` si elle n'a pas trouvé la valeur dans le tableau, et retourne l'id de la valeur si elle la trouve

### Fonctions

```php
function functionName(argType arg) : returnValueType
```

### Blocs fonctionnels

On peut créer des fichiers en PHP et les appeler dans d'autres pages de notre site.

Par exemple, on peut créer notre header et notre footer en HTML avec des fichiers `header.php` et `footer.php` et les appeler directement dans les différentes pages de notre site, nous évitant ainsi de devoir les copier coller et nous permettant de les changer sur toutes les pages à un seul endroit.

Pour cela il suffit d'utiliser la fonction `require_once` dans les pages où on souhaite appeler notre fichier :

```php
b <?php require_once(__DIR__ . '/header.php'); ?>
```

`__DIR__` est une constante magique en PHP qui renvoie le chemin absolu du répertoire du fichier courant.

On indique ensuite le chemin pour accéder au fichier PHP que l'on souhaite intégrer.

On peut également utiliser cette méthode pour extraire nos variables et nos fonctions du fichier qui compose notre page, et les appeler sur les pages pour lesquelles c'est nécéssaire.

### URLs et Requêtes

A la fin des URLs, on peut transmettre un certain nombre de paramètres (en général jusqu'à 256 caractères), en les séparant du nom de la page par un point d'interrogation `?`

Pour que cela soit correct en HTML, il faut remplacer `?` par `&amp;`

```html
<a href="bonjour.php?nom=Dupont&amp;prenom=Jean">Dis-moi bonjour !</a>
```

#### method="GET"

Pour faire passer des informations d'une page à l'autre grâce à l'URL, on peut utiliser un formulaire en HTML qui aura pour attribut la méthode `GET`

Le formulaire sera alors converti en URL lors de sa soumission, et on pourra récupérer les informations grâce à une supervariable `$_GET`, qui contiendra nos différents paramètres et leurs valeurs sous la forme d'un dictionnaire.

**CEPENDANT** il ne faut jamais faire confiance aux données qui transitent de cette façon, car il est très facile de modifier l'URL, et donc de modifier les informations transmises au serveur.

#### method="post"

Grâce à cette méthode, les données ne transitent plus via l'URL. On a plus la limite de 256 caractères, donc on peut faire voyager beaucoup plus de données. Cependant, cette méthode n'est pas plus sécurisée que GET, donc il faut quand même mettre en place des barrières pour éviter les failles.

C'est souvent la meilleure option, à privilégier.

Les informations seront stockées dans la supervariable `$_POST`

#### Champs cachés

On peut faire transiter des informations via un formulaire, sans que l'utilisateur ne puisse en théorie les voir ni les modifier, grâce aux champs cachés

```html
<input type="hidden" name="variableName" value="variableValue" />
```

Ces données seront ajoutées à la supervariable `$_GET` ou `$_POST` comme les autres.

ATTENTION : Il reste tout de même la possibilité à l'utilisateur d'inspecter la page pour modifier ces données, donc il faut rester vigilant.

#### Contrôler nos données

La fonction `isset` nous permet de vérifier qu'une variable existe. Cela nous permet d'afficher un message dans le cas où il manquerait des informations nécessaires.

La fonction `filter_var` nous permet de vérifier que notre donnée correspond à un format attendu, passé en deuxième argument. Par exemple, l'argument `FILTER_VALIDATE_EMAIL` permet de vérifier qu'il s'agit bien d'une adresse mail.

La fonction `empty` renvoie un booléen qui nous renvoie vrai si la valeur de la variable est NULL, et faux dans le cas contraire.

##### Faille XXS

La faille XXS consiste à l'injection de données via un formulaire, par exemple de balises HTML innofensives ou, plus grave, de scripts javascript pouvant causer des problèmes de sécurité grave.

Pour pallier ce problème, on peut utiliser la fonction `htmlspecialchars`, qui permet de remplacer les balises HTML `<` et `>` empêchant ainsi leur exécution.

```php
<p><b>Message</b> : <?php echo htmlspecialchars($_POST['message']); ?></p>
```

On peut également utiliser la fonction `strip_tags`, qui supprimera tout simplement toutes les balises HTML contenues dans le message.

#### Envoi de fichiers

Pour pouvoir envoyer des fichiers via un formulaire, il faut ajouter l'attribut `enctype="multipart/form-data"` à la balise `<form>`.

Puis il suffit d'ajouter une balise `<input type="file" />` avec ses attributs, notamment `name`

Après l'envoi du formulaire, le fichier est stocké dans un dossier temporaire sur le serveur. Il faut le traiter dans la page de réception du formulaire afin de déterminer ce qu'on fait avec.

Une supervarible `$_FILES` est créée, avec un dictionnaire du nom de l'attribut `name` à l'intérieur. Ce dictionnaire contiendra les informations relatives au fichier.

Par exemple, si le fichier est un screenshot (et est appelé ainsi dans le formulaire), on aura les informations suivantes :

`$_FILES['screenshot']['name']` : Le nom du fichier
`$_FILES['screenshot']['type']` : L'extension du fichier
`$_FILES['screenshot']['size']` : La taille du fichier
`$_FILES['screenshot']['tmp_name']` : L'emplacement temporaire du fichier
`$_FILES['screenshot']['error']` : Vaut 0 s'il n'y a pas eu d'erreur à l'envoi

##### Les points à vérifier

1. Envoi du fichier

On vérifie si la variable existe et si sa clé `error` vaut bien `0`

```php
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0)
```

2. Taille du fichier

On choisit une taille maximum, et vérifie que le fichier n'est pas trop volumineux, en `octets`. Par exemple, si on choisit une taille max de `1Mo` :

```php
if ($_FILES['screenshot']['size'] > 1000000) {
    echo "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";
    return;
}
```

3. Extension du fichier

On récupère l'extension de notre fichier que l'on stocke dans une variable `$extension`, puis on la compare à un array `allowedExtensions` que l'on aura défini à l'avance grâce à la fonction `in_array()`

```php
$fileInfo = pathinfo($_FILES['screenshot']['name']);
$extension = $fileInfo['extension'];
$allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
if (!in_array($extension, $allowedExtensions)) {
    echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
    return;
}
```

4. Emplacement de stockage du fichier

On vérifie que le dossier dans lequel on souhaite stocker le fichier existe grâce à la fonction `is_dir()`.

```php
$path = __DIR__ . '/uploads/';
if (!is_dir($path)) {
    echo "L'envoi n'a pas pu être effectué, le dossier uploads est      manquant";
    return;
}
```

##### Valider l'envoi du fichier

Si tous les points précédents sont valides, on utilise la fonction `move_uploaded_file()` pour enregistrer le fichier.

Cette fonction prend 2 paramètres :

- Le nom temporaire du fichier `$_FILES['screenshot']['tmp_name']`
- Le nom sous lequel on stockera le fichier définitivement. On peut garder le nom d'origine grâce à `basename()` ou générer un nom au hasard.

```php
 move_uploaded_file($_FILES['screenshot']['tmp_name'], $path . basename($_FILES['screenshot']['name']));
```

##### Remarques

- Lorsque vous mettrez le script sur Internet à l'aide d'un logiciel FTP, vérifiez que le dossier « Uploads » sur le serveur existe, et qu'il a les droits d'écriture. Pour ce faire, sous FileZilla par exemple, faites un clic droit sur le dossier et choisissez « Attributs du fichier ».
  Cela vous permettra d'éditer les droits du dossier (on parle de CHMOD). Mettez les droits à 733, ainsi PHP pourra placer les fichiers téléversés dans ce dossier.

- Il est plus adapté de choisir soit même le nom des fichiers uploadés, pour éviter les problèmes liés à certains caractères ou aux doublons.

- Il faut être très vigilant sur la sécurité, pour éviter que quelqu'un puisse envoyer des fichiers malveillants sur le serveur.

### Sessions...

Une session permet de conserver en mémoire des variables de page en page pour fluidifier la navigation d'un utilisateur.

Afin de les mettre en place, il faut impérativement commencer son fichier .php par la fonction `session_start()`, avant même de rédiger la moindre ligne de code.

Un ID de session (ou `PHPSESSID`) est alors généré pour notre utilisateur.
Grâce à cette session, on peut créer une infinité de variables qui seront stockées dans la supervarial `$_SESSION` comme le nom et le prénom de l'utilisateur par exemple.

`session_destroy()` est la fonction qui permet d'effacer ces informations. Elle est appelée automatiquement lorsque le visiteur est inactif pendant quelques minutes, ou peut être appelée à l'aide d'un bouton de déconnexion par exemple.

**ATTENTION** Pour une raison que j'ignore, un bouton de déconnexion qui supprime la session ne fonctionne pas avec seulement cette fonction. Il faut d'abord s'assurer qu'elle est créée, et supprimer son contenu avant de la détruire ?

```php
<?php
    session_start();
    require_once(__DIR__ . '/functions.php');
    session_unset();
    session_destroy();
    redirectToUrl('index.php');
?>
```

#### Quelques exemples de l'utilité des sessions

- Sur un site où une connexion est nécessaire, la session permet de rester connecté à son compte tout en naviguant sur le site

- Logiquement, cela permet d'autoriser ou de restreindre automatiquement l'accès à certaines pages du site, en attribuant une variable `$_SESSION["admin"]` par exemple.

- Sur un site e-commerce, ce sont les sessions qui permettent de garder un panier en mémoire.

#### Philosophie du formulaire de connexion

- Créer un fichier `login.php` pour créer le formulaire de connexion

- Créer un fichier `submit_login.php` pour créer le comportement de notre site à l'envoi du formulaire

- Rediriger l'utilisateur vers `index.php` si le formulaire de connexion a abouti à une connexion.

Pour cela, on crée une fonction `redirectToUrl()` qui est appelée à la fin de `submit_login.php` :

```php
<?php
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}
```

La première ligne de cette fonction indique au navigateur qu'il doit charger une nouvelle page grâce à la fonction `header()`
`exit()` arrête immédiatement le reste du code PHP, afin d'éviter que d'autres instructions ne perturbent la redirection.

### .. et Cookies !

La différence entre les sessions et les cookies est que ces premières sont stockées sur le serveur, et sont détruites à l'appel de `session_destroy()`, tandis que ces derniers sont conservés sur l'ordinateur de l'utilisateur sous la forme d'un fichier texte, permettant une conservation des données dans le temps.

Chaque cookie est utilisé pour stocké une seule information. Il faudra donc générer autant de cookies que de variables que l'on souhaite stocker en mémoire.

#### Créer un cookie

On utilise la fonction `setcookie`, qui prendra 3 arguments :

- Le nom du cookie
- La valeur du cookie
- La date d'expiration du cookie, sous forme de timestamp (ex: `1090521508`).

##### Timestamp

Il s'agit du nombre de secondes écoulées depuis le 01/01/1970.

On peut obtenir le timestamp actuel grâce à la fonction `time()`

Il suffit de lui ajouter la durée pour laquelle on souhaite conserver le cookie en secondes, et de passer cette valeur comme argument à la fonction `setcookie`

*Par exemple, `time() + 365*24*60*60` renverra le timestamp d'un an après la génération du cookie.\*

#### Sécuriser un cookie

Cette opération permet d'éviter les failles XSS vues précédemment en passant par les cookies.

Pour cela, on utilise les options `httpOnly` et `secure`, de cette manière :

```php
<?php
// retenir l'email de la personne connectée pendant 1 an
setcookie(
    'LOGGED_USER',
    'utilisateur@exemple.com',
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
);
```

Il faut également veiller à ne jamais placer de code HTML avant `setcookie`.

#### Utiliser un cookie

Avant de générer une page, PHP lit les cookies et place les informations qu'ils contiennent dans une supervariable `$_COOKIE`

On peut donc y accéder en utilisant, par exemple `$_COOKIE['LOGGED_USER']`

#### Modifier un cookie

Si l'on souhaite modifier un cookie, il suffit d'en générer un nouveau avec `setcookie()` en gardant le même nom.

Cela aura également pour effet de reset la durée de conservation du cookie.

## MySQL et Bases de données

Voir CS50\CS50X\07 - SQL.md

### phpMyAdmin

phpMyAdmin est un outil de gestion des bases de données SQL. Il permet de créer, modifier, importer ou exporter des bases de données facilement, sans avoir à écrire de MySQL.

### Connecter PHP à MySQL avec PDO

Il faut véfifier dans phpinfo() que PDO est bien activé sur le serveur. Si ce n'est pas le cas, on va modifier `php.ini` pour l'activer.

Pour connecter PHP à MySQL, on vient donner cette instruction `PDO` :

```php
<?php
$mysqlClient = new PDO(
	'mysql:host=localhost;dbname=partage_de_recettes;charset=utf8',
	'root',
	''
);
?>
```

- `host` est le nom de l'hôte. C'est l'adresse IP de l'ordinateur où MySQL est installé. Le plus souvent, c'est sur le même ordinateur que celui sur lequel PHP est installé, donc on peut utiliser la valeur `localhost`

- `dbname` est le nom de la base de données à laquelle on souhaite se connecter, ici `partage_de_recettes`

- L'identifiant et le mot de passe : ils permettent de vous identifier. Renseignez-vous auprès de votre hébergeur pour les connaître. (ID =`root` et pas de mot de passe (`''`) pour `XAMPP`)

Lorsque votre site sera en ligne, vous aurez sûrement un nom d'hôte différent, ainsi qu'un identifiant et un mot de passe, comme ceci :

```php
<?php
$mysqlClient = new PDO('mysql:host=sql.hebergeur.com;dbname=mabase;charset=utf8', 'pierre.durand', 's3cr3t');
?>
```

Il faudra donc penser à changer cette ligne pour l'adapter à votre hébergeur en modifiant les informations en conséquence, lorsque vous enverrez votre site sur le Web.

#### Tester les erreurs

S'il y a une erreur (vous vous êtes trompé de mot de passe ou de nom de base de données, par exemple), PHP risque d'afficher toute la ligne qui pose l'erreur, ce qui inclut le mot de passe !

Vous ne voudrez pas que vos visiteurs puissent voir le mot de passe si une erreur survient lorsque votre site est en ligne. Il est préférable de traiter l'erreur.

En cas d'erreur, PDO renvoie ce qu'on appelle une exception, qui permet de « capturer » l'erreur.

Pour cela on utilise `try` et `catch` (similaire à la gestion des exceptions en python)

```php
<?php
try
{
	$mysqlClient = new PDO('mysql:host=localhost;dbname=partage_de_recettes;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
```

PHP essaie d'exécuter les instructions à l'intérieur du bloc try :

S'il y a une erreur, il rentre dans le bloc catch et fait ce qu'on lui demande (ici, on arrête l'exécution de la page en affichant un message décrivant l'erreur).

Si au contraire tout se passe bien, PHP poursuit l'exécution du code et ne lit pas ce qu'il y a dans le bloc catch . Votre page PHP ne devrait donc rien afficher pour le moment.

### Requête MySQL avec PDO

```php
<?php
$recipesStatement = $mysqlClient->prepare('SELECT * FROM recipes');
?>
```

Grâce à cette requête, on va récupérer toutes les informations de la table `recipes`

Cependant on reçoit un PDOStatement, inexploitable en l'état. Il faut rajouter quelques lignes de code qui permettent de convertir ces données en un tableau PHP

```php
<?php
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();
?>
```

### Construire des requêtes en fonction de variables

#### Marqueurs

Pour utiliser un marqueur, on vient remplacer une valeur dans notre requête SQL par un `?`, indiquant ainsi que cette valeur là n'est pas définie.

Lorsqu'on a plusieurs valeurs à remplacer, on va préférer les nommer, pour s'y retrouver plus facilement, sous la forme `:name`

On peut passer les valeurs de ces variables via la fonction `execute()`, grâce à un tableau.

```php
<?php
$sqlQuery = 'SELECT * FROM recipes WHERE author = :author AND is_enabled = :is_enabled';

$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([
'author' => 'mathieu.nebra@exemple.com',
'is_enabled' => true,
]);
$recipes = $recipesStatement->fetchAll();
?>
```

Ce snippet permet de n'afficher sur le site que les recettes de mathieu qui ont été activées.
Dans ce cas, il est "hard-codé", mais on peut imaginer ajouter des filtres sur le site, qui permettraient à l'utilisateur de choisir lui même quelles données de la base il souhaite afficher.

**On ne concatène JAMAIS une requête SQL pour passer des variables, au risque de créer des injections SQL ! Le sujet des injections SQL est un peu trop complexe pour être détaillé ici. Si vous souhaitez en apprendre plus à ce sujet, je vous invite à consulter Wikipedia.**

#### Trouver et réparer les erreurs

Lorsqu'une requête SQL foire, l'erreur affichée sera souvent indiquée au `fetchAll`, alors qu'elle est située au niveau de la requête SQL.

On peut modifier notre PDO afin de régler ce problème :

```php
<?php
$mysqlClient = new PDO(
    'mysql:host=localhost;dbname=partage_de_recettes;charset=utf8',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
?>
```

#### Best practices

**Utiliser des constantes** dans `mysql.php` afin de les transmettre facilement à `databaseconnect.php`

### Fonctions SQL

#### Fonctions scalaires

Ces fonctions permettent de modifier les valeurs d'un champ avant de les transmettre à PHP. Elle ne changent pas les valeurs dans la base de données, mais les modifie juste avant de les transmettre à PHP pour qu'il les affiche.

Par exemple, la fonction `DATE_FORMAT()` permet de récupérer un timestamp pour le convertir dans le format de notre choix, par exemple `DD/MM/YYYY`

```SQL
SELECT *, DATE_FORMAT(c.created_at, "%d/%c/%Y") AS comment_date FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = 1
```

On lui donne un nom pour pouvoir plus facilement récupérer ses données, ici `comment_date`.

C'est ce qu'on appelle un **champ virtuel**, car PHP le récupère comme s'il s'agissait d'un champ de notre table de données, mais il s'agit en fait d'une création éphémère, juste faite pour être transmise à PHP.

`ROUND()` est une fonction scalaire qui permet d'arrondir une valeur.

#### Fonction d'agrégat

Une fonction d'agrégat fonctionne différemment d'une fonction scalaire. Au lieux de s'appliquer à chacune des entrées, elle va faire son opération sur plusieurs entrées pour retourner une seule valeur.

La fonction `AVG()` par exemple, va calculer la moyenne de toutes les lignes d'un champ.

Par exemple pour un champ `review` qui contiendrait des notes de 0 à 5 pour noter le contenu d'une page dans un commentaire, cela nous donnerait la requête :

```SQL
SELECT AVG(c.review) as rating FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = 1
```

Ici aussi, on lui donne un alias `rating`, pour pouvoir travailler plus facilement avec dans le reste du code.

On peut utiliser `ROUND()` sur cette valeur, ce qui nous permet d'avoir un résultat plus propre.

Etant donné qu'on sait qu'on a utilisé une fonction d'agrégat et que l'on n'aura qu'une entrée en réponse, on peut également remplacer `fetchAll()` par `fetch()`

```php
<?php
$sqlQuery = 'SELECT ROUND(AVG(c.review),1) as rating FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = 1';

// Préparation
$averageRatingStatment = $mysqlClient->prepare($sqlQuery);

// Exécution
$averageRatingStatment->execute();

/** La fonction fetch est plus performante que fetchAll()
 * quand nous sommes certain(e)s de ne récupérer qu'une ligne.
 * https://www.php.net/manual/fr/pdostatement.fetch.php
 */
$averageRating = $averageRatingStatment->fetch();
```

**ATTENTION** : Lorsqu'on utilise une fonction d'agrégat, il ne faut pas demander d'autres champs dans la même requête, car une partie nous donnerait une entrée et une autre toutes les entrées du champs, impossible à représenter dans un tableau complet donc.

`WHERE` permet de filtrer les données avant de les récupérer, `HAVING` permet de filtrer les données après les avoir agrégées grâce à une fonction d'agrégat.

Par exemple, pour afficher tous les commentaires qui ont mis une note inférieure 3, on utilise `WHERE`

Pour afficher toutes les recettes qui ont eu une note moyenne inférieure à 3, on utilise `HAVING`