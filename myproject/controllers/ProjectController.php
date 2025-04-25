<?php
class ProjectController {
    private $db;
    private $project;

    public function __construct($db) {
        $this->db = $db;
        $this->project = new Project($db);
    }

    public function getAllProjects() {
        return ["success" => true, "projects" => $this->project->getAllProjects()];
    }

    public function getProjectsByCategory($category) {
        return ["success" => true, "projects" => $this->project->getProjectsByCategory($category)];
    }
}
?>