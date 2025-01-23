<?php

// phpinfo();

$name = "bob";
$bob = 5;

function product($a, $b){
    return $a * $b;
}

// Indirection affiche le contenu d'une variable 
// dont le nom est le contenu de la variable name
echo $$name . $name . '<br>';

$result = product(5,8);
echo "{$$name} $name $result <br>";
