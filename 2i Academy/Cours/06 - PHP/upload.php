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