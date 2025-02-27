<?php
$request_uri = $_SERVER['REQUEST_URI'];
// echo $request_uri;
if ($request_uri == "/data") {
    $response = [
        "message" => "PHP Backend", 
        "status" => "success"
    ];
    echo json_encode($response);
}
if($request_uri === "/"){
    echo require "./inClass13.html";
}


?>