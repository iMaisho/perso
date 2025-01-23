<?php

function removeTag(string $tagList, string $tagToDelete){
    $tagArray = array_filter(
        explode(" ", $tagList),
        fn ($tag) => $tag != $tagToDelete
    );

    return implode(" ", $tagArray);
}

function snakeToCamel(string $name){
    $parts = explode("_", $name);
    $first = array_shift($parts);
    $camelized = array_map(
        fn ($item) => ucfirst($item),
        $parts
    );
    return $first . implode("", $camelized);
}


echo snakeToCamel("game_of_throne");

$tags = "#web #php #dev";

echo removeTag($tags, "#php");