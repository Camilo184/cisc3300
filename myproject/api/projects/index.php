<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Project.php';
require_once __DIR__ . '/../../controllers/ProjectController.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

$controller = new ProjectController($db);

if(isset($_GET['category']) && !empty($_GET['category'])) {
    $result = $controller->getProjectsByCategory($_GET['category']);
} else {
    $result = $controller->getAllProjects();
}

http_response_code(200);

echo json_encode($result);
?>