<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "error" => "Method Not Allowed"]);
    exit;
}

require_once __DIR__ . '/../../database.php';
require_once __DIR__ . '/../../Message.php';
require_once __DIR__ . '/../../MessageController.php';

$data = json_decode(file_get_contents("php://input"));

$db = (new Database())->getConnection();
$controller = new MessageController($db);

$response = $controller->createMessage($data);

echo json_encode($response);
