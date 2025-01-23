<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/dbconnect.php');


$postData = $_POST;

if (isset($postData['request_id'])) {
    $changeAnswered = $mysqlClient->prepare('UPDATE requests SET answered = NOT answered WHERE user_id = :id');
    
    $changeAnswered->execute([
        'id' => $postData["request_id"]
    ]);

    echo json_encode(["success" => true, "message" => "Requête traitée avec succès."]);
} else {
    echo json_encode(["success" => false, "message" => "ID de requête manquant."]);
}
exit;


?>