<?php

$person = [
    "name" => "John",
    "age" => 21,
    "height" => "6'11"
];


foreach ($person as $key => $value) {
    echo "{$key} is {$value}.<br>";
}


function greet(string $name, ?string $title = null): string {
    if ($title) {
        return "Hi {$title} {$name}";
    } else {
        return "Hi {$name}";
    }
}


echo greet("John") . "<br>";
echo greet("John", "Mr") . "<br>";
?>
