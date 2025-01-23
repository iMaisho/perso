<?php
session_start();
require_once(__DIR__ . '/functions.php');


$postData = $_POST;


if (isset($postData['username']) &&  isset($postData['password'])) {
    if (!strip_tags($postData['username']) === 'admin' || !strip_tags($postData['password'] === 'admin')) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
    } else {
                $_SESSION['LOGGED_USER'] = [
                    'username' => strip_tags($postData['username']),
                ];
            }
            redirectToUrl('database_access.php');
        }




