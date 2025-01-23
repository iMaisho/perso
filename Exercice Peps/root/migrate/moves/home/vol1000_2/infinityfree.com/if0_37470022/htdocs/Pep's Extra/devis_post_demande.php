<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/dbconnect.php');

// Vérifications
$postData = $_POST;

$errors = [];


if (empty($postData['lastname'])) {
    $errors['lastname'] = 'Le nom est requis.';
}
if (empty($postData['firstname'])) {
    $errors['firstname'] = 'Le prénom est requis.';
}
if (empty($postData['phone']) || !preg_match('/(0|\\+33)[1-9][0-9]{8}$/', $postData['phone'])) {
    $errors['phone'] = 'Le téléphone est incorrect ou manquant.';
}
if (empty($postData['email']) || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'L\'email est incorrect ou manquant.';
}
if (empty($postData['budget']) || !is_numeric($postData['budget'])) {
    $errors['budget'] = 'Le budget doit être un chiffre valide.';
}
if (empty($postData['deadline'])) {
    $errors['deadline'] = 'La date limite est requise.';
}
if (empty($postData['description'])) {
    $errors['description'] = 'La description est requise.';
}


if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'errors' => $errors]);
    exit;
}

if(empty($postData['company'])){
    $postData['company'] = 'N/A';
}

// Gestion du fichier
$isFileLoaded = false;
// Testons si le fichier a bien été envoyé et s'il n'y a pas des erreurs
if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    // Testons, si le fichier est trop volumineux
    if ($_FILES['file']['size'] > 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou fichier trop volumineux";
        return;
    }

    // Testons, si l'extension n'est pas autorisée
    $fileInfo = pathinfo($_FILES['file']['name']);
    $extension = strtolower($fileInfo['extension']);
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
        return;
    }

    // Testons, si le dossier uploads est manquant
    $path = __DIR__ . '/uploads/';
    if (!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
        return;
    }

    // On peut valider le fichier et le stocker définitivement
    move_uploaded_file($_FILES['file']['tmp_name'], $path . basename(strtolower($postData['lastname'] . '-' . $postData['firstname'] . '.' . $extension)));
    $isFileLoaded = true;
}

// Insertion en BDD
$lastname = trim(strip_tags($postData['lastname']));
$firstname = trim(strip_tags($postData['firstname']));
$company = trim(strip_tags($postData['company']));
$phone = trim(strip_tags($postData['phone']));
$email = trim(strip_tags($postData['email']));

$insertUser = $mysqlClient->prepare('INSERT INTO users (lastname, firstname, company, phone, email) VALUES (:lastname, :firstname, :company, :phone, :email)');
$insertUser->execute([
    'lastname' => $lastname, 
    'firstname' => $firstname, 
    'company' => $company, 
    'phone' => $phone,
    'email' => $email,
]);


$userId = $mysqlClient->lastInsertId();

$needs = trim(strip_tags($postData['needs']));
$budget = trim(strip_tags($postData['budget']));
$deadline = trim(strip_tags($postData['deadline']));
$description = trim(strip_tags($postData['description']));

$insertRequest = $mysqlClient->prepare('INSERT INTO requests (user_id, needs, budget, deadline, description) VALUES (:user_id, :needs, :budget, :deadline, :description)');
$insertRequest->execute([
    'user_id' => $userId, 
    'needs' => $needs,
    'budget' => $budget, 
    'deadline' => $deadline, 
    'description' => $description,
]);


echo json_encode(['status' => 'success']);
exit;
?>
<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/dbconnect.php');

// Vérifications
$postData = $_POST;

$errors = [];


if (empty($postData['lastname'])) {
    $errors['lastname'] = 'Le nom est requis.';
}
if (empty($postData['firstname'])) {
    $errors['firstname'] = 'Le prénom est requis.';
}
if (empty($postData['phone']) || !preg_match('/(0|\\+33)[1-9][0-9]{8}$/', $postData['phone'])) {
    $errors['phone'] = 'Le téléphone est incorrect ou manquant.';
}
if (empty($postData['email']) || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'L\'email est incorrect ou manquant.';
}
if (empty($postData['budget']) || !is_numeric($postData['budget'])) {
    $errors['budget'] = 'Le budget doit être un chiffre valide.';
}
if (empty($postData['deadline'])) {
    $errors['deadline'] = 'La date limite est requise.';
}
if (empty($postData['description'])) {
    $errors['description'] = 'La description est requise.';
}


if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'errors' => $errors]);
    exit;
}

if(empty($postData['company'])){
    $postData['company'] = 'N/A';
}

// Gestion du fichier
$isFileLoaded = false;
// Testons si le fichier a bien été envoyé et s'il n'y a pas des erreurs
if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    // Testons, si le fichier est trop volumineux
    if ($_FILES['file']['size'] > 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou fichier trop volumineux";
        return;
    }

    // Testons, si l'extension n'est pas autorisée
    $fileInfo = pathinfo($_FILES['file']['name']);
    $extension = strtolower($fileInfo['extension']);
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
        return;
    }

    // Testons, si le dossier uploads est manquant
    $path = __DIR__ . '/uploads/';
    if (!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
        return;
    }

    // On peut valider le fichier et le stocker définitivement
    move_uploaded_file($_FILES['file']['tmp_name'], $path . basename(strtolower($postData['lastname'] . '-' . $postData['firstname'] . '.' . $extension)));
    $isFileLoaded = true;
}

// Insertion en BDD
$lastname = trim(strip_tags($postData['lastname']));
$firstname = trim(strip_tags($postData['firstname']));
$company = trim(strip_tags($postData['company']));
$phone = trim(strip_tags($postData['phone']));
$email = trim(strip_tags($postData['email']));

$insertUser = $mysqlClient->prepare('INSERT INTO users (lastname, firstname, company, phone, email) VALUES (:lastname, :firstname, :company, :phone, :email)');
$insertUser->execute([
    'lastname' => $lastname, 
    'firstname' => $firstname, 
    'company' => $company, 
    'phone' => $phone,
    'email' => $email,
]);


$userId = $mysqlClient->lastInsertId();

$needs = trim(strip_tags($postData['needs']));
$budget = trim(strip_tags($postData['budget']));
$deadline = trim(strip_tags($postData['deadline']));
$description = trim(strip_tags($postData['description']));

$insertRequest = $mysqlClient->prepare('INSERT INTO requests (user_id, needs, budget, deadline, description) VALUES (:user_id, :needs, :budget, :deadline, :description)');
$insertRequest->execute([
    'user_id' => $userId, 
    'needs' => $needs,
    'budget' => $budget, 
    'deadline' => $deadline, 
    'description' => $description,
]);


echo json_encode(['status' => 'success']);
exit;
?>
