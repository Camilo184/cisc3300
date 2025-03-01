<?php
$request_uri = $_SERVER['REQUEST_URI'];
// echo $request_uri;
if ($request_uri == "http://localhost:8888") {
    $response = ["message" => "Form submitted successfully!"];
    echo json_encode($response);
}



?>