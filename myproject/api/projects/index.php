<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database and model files
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Project.php';
require_once __DIR__ . '/../../controllers/ProjectController.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

// Initialize controller - UNCOMMENT THIS LINE
$controller = new ProjectController($db);

// Check if category parameter exists
if(isset($_GET['category']) && !empty($_GET['category'])) {
    // Get projects by category
    $result = $controller->getProjectsByCategory($_GET['category']);
} else {
    // Get all projects
    $result = $controller->getAllProjects();
}

// Set response code - 200 OK
http_response_code(200);

// Return response
echo json_encode($result);
?>