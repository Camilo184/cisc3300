<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database and model files
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../../models/Project.php';
include_once __DIR__ . '/../../controllers/ProjectController.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Initialize controller
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