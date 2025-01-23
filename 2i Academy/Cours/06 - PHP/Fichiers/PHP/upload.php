<?php

var_dump($_FILES);
$isFileLoaded = false;

if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {

    if ($_FILES['file']['size'] > 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou fichier trop volumineux";
        return;
    }

    $fileInfo = pathinfo($_FILES['file']['name']);
    $extension = strtolower($fileInfo['extension']);
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
        return;
    }

    $path = __DIR__ . '/uploads/';
    if (!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
        return;
    }

    move_uploaded_file($_FILES['file']['tmp_name'], $path . uniqid('') . '.' . $extension);
    $isFileLoaded = true;

    echo "Le fichier a bien été uploadé";
}


/**
 * @author moi
 * @param string $tags la liste de tags
 * @param string $tagToDelete le tag à supprimer
 * @return string la nouvelle liste de tags filtrée
 * Cette fonction supprime un tag au sein d'une chaîne de caractères représentant une liste de tags
 * 
 * Exemple
 * removeTag("#test #web #food", "#web");
 * supprime le tag web
 */

$tags = "#php #info #web #choucroute #dev";
function removeTag(string $tagToDelete, string $tags):string{
    if (mb_substr($tagToDelete, 0, 1) != "#"){
        $tagToDelete = "#" . $tagToDelete;
    }
    $tagList = explode(" ", $tags);
    $filteredList = array_filter(
        $tagList, 
        fn ($item) => $item != $tagToDelete
    );
     return $tagsNew = implode(" ", $filteredList);
}

echo $tags;
echo removeTag("info", $tags);