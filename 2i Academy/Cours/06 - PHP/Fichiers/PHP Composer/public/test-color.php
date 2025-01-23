<?php

use Mexitek\PHPColors\Color;
use M2i\App\Models\User;

require "../vendor/autoload.php";

$color = new Color("FF0000");
$newColor = $color->complementary();

echo $newColor;

$faker = Faker\Factory::create("fr_FR");
$name = $faker->name();

$whoops = new Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

echo 1/0;

$user = new User("GI Joe")
?>

<div style="background:<?=$color?>"><?=$name?></div>
<div style="background:#<?=$newColor?>">aaaa</div>

