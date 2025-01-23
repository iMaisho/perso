<?php

require "classes/Form.php";

$form = new Form();

$form->addField(new FormField("nom", "Votre nom"))
-> addField(new FormField("age", "Votre age", "number"));

$form->hydrate(["nom" => "Antonin Mingam", "age" => 56, "test" => true]);

echo $form->__toString();