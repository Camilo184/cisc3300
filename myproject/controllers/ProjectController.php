<?php
require_once '../models/Project.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["success" => false, "error" => "Method Not Allowed"]);
    http_response_code(405);
    exit;
}

$project = new Project();
$data = $project->getAllProjects();
echo json_encode(["success" => true, "projects" => $data]);
?>
