<?php

require_once 'Model/Model.php';
require_once 'Controller/Controller.php';

use Controller\Controller;

header('Content-Type: application/json');

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($requestUri === '/posts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new Controller();
    $controller->index();
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
}
