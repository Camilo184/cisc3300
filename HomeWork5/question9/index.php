<?php
$request_uri = $_SERVER['REQUEST_URI'];
// echo $request_uri;
if ($request_uri == "/data") {
    $response = [
        ["name" => "Product A", "price" => 10.99],
        ["name" => "Product B", "price" => 14.99],
    ];
    echo json_encode($response);
}
if($request_uri === "/"){
    echo require "./question9.html";
}


?>