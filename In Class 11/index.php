<?php

//we need this to accept requests from any domain
header("Access-Control-Allow-Origin: *");

$uri = strtok($_SERVER["REQUEST_URI"], '?');

//get uri pieces
$uriArray = explode("/", $uri);
//var_dump($uriArray);

if ($uriArray[1] === 'test' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $test = [
        [
            'name' => 'pinecone'
        ],
        [
            'name' => 'Mr'
        ]
    ];

    echo json_encode($test);
    exit();
}

if ($uriArray[1] === 'form' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode([
        'message' => 'Success'
    ]);
    exit();
}


?>
