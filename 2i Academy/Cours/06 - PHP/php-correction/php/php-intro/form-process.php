<?php


$contactData = $_POST["contact"];
$addressData = $_POST["adresse"];

$addressData["code_postal"] = 7520;

var_dump($addressData);
