<h1>Test du DAO</h1>

<?php

use M2i\Core\ORM\DAO;
use M2i\Core\ORM\QueryBuilder;

$dao = new DAO(PDO, new QueryBuilder, "users");

var_dump($dao->findOneById(1));