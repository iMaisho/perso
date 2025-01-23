<?php
use M2i\Core\ORM\QueryBuilder;

$rootDir = dirname(dirname(__DIR__));

var_dump($rootDir);
include $rootDir."/vendor/autoload.php";

/*
$qb = new QueryBuilder;
$qb ->select()
    ->from("clients")
    ->addField("id")
    ->addField("name");

echo $qb->getQuery();
*/

$pdo = new PDO(
    "mysql:host=mariadb;port=8003;dbname=formation", 
    "root", "123"
);

var_dump($pdo);