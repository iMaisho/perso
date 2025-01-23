<?php


function isUserAuthenticated(): bool{
    return isset($_SESSION["user"]);
}

function getUserName(){
    if(isUserAuthenticated()){
        return $_SESSION["user"]["user_name"];
    }

    return "Anomyne";
}


function findOneUserByLogin(string $login): array|bool{
    $sql = "SELECT * FROM users WHERE login_name = ?";
    $statement = PDO->prepare($sql);
    $statement->execute([$login]);
    return $statement->fetch();
}

function authenticateUser(string $plainPassword, array $user, array &$errors):void{
    if(! password_verify($plainPassword, $user['password_hash'])){
        array_push($errors, "Mot de passe incorrect");
    } else {
        unset($user['password_hash']);
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        //header("location:/accueil");
    }
}