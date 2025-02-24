<?php
$request_uri = $_SERVER['REQUEST_URI'];
echo $request_uri;
if ($request_uri == "/html") {
    echo "<h1>Welcome to the HTML page!</h1>";
    echo "<p>HTML response.</p>";
} elseif ($request_uri == "/json") {
    $response = ["message" => "JSON response", "status" => "success"];
    echo json_encode($response);
} else {
    // echo "Page not found!";
}
?>
