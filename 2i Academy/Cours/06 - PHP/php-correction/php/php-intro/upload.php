<?php
// le formulaire a-t-il été posté
$isPosted = filter_has_var(INPUT_POST, "submit");
// Un fichier est-il présent
$hasUploadedFile = isset($_FILES["fichier"]);

// Liste des types de fichiers permis
$allowedTypes = [
    "image/jpeg" => "jpg",
    "image/png" => "png"
];

$showImage = false;
$error = "";

// Traitement de l'upload
if($isPosted && $hasUploadedFile){
    // On épargne ses pauvres petits doigts 
    $file = $_FILES["fichier"];
    // On tente de récupèrer l'extension
    $ext = $allowedTypes[$file["type"]] ?? false;

    // Si extension ok et pas d'erreur
    if($ext && $file["error"] == "0"){
        $targetPath = getcwd(). "/uploads/";
        $fileName = uniqid("img-"). "." . $ext;
        $filePath = $targetPath. $fileName;

        if(move_uploaded_file($file["tmp_name"], $filePath)){
            $showImage = true;
        } else {
            $error = "Impossible de déplacer le fichier temporaire";
        }
    } else {
        $error = "Erreur de téléchargement";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>

<?php if(! empty($error)): ?>
    <div style="color: white; background: red">
        <?= $error ?>
    </div>
<?php endif; ?>

<?php if($showImage): ?>
    <img src="uploads/<?=$fileName?>">

<?php else: ?>
    <form   method="post" 
        action="upload.php"
        enctype="multipart/form-data">

    <input type="file" name="fichier">
    <button type="submit" name="submit">Envoyer</button>
</form>
<?php endif; ?>
 
</body>
</html>