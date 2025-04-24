<?php
class ProjectController {
    private $db;
    private $project;

    public function __construct($db) {
        $this->db = $db;
        $this->project = new Project($db);
    }

    // Get all projects
    public function getAllProjects() {
        $stmt = $this->project->read();
        $num = $stmt->rowCount();
        
        if($num > 0) {
            $projects_arr = [];
            $projects_arr["records"] = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                $project_item = [
                    "id" => $id,
                    "title" => $title,
                    "description" => $description,
                    "image" => $image,
                    "category" => $category,
                    "demo_link" => $demo_link,
                    "code_link" => $code_link,
                    "tags" => explode(",", $tags)
                ];
                
                array_push($projects_arr["records"], $project_item);
            }
            
            return $projects_arr;
        } else {
            return ["message" => "No projects found."];
        }
    }

    // Get projects by category
    public function getProjectsByCategory($category) {
        $stmt = $this->project->readByCategory($category);
        $num = $stmt->rowCount();
        
        if($num > 0) {
            $projects_arr = [];
            $projects_arr["records"] = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                $project_item = [
                    "id" => $id,
                    "title" => $title,
                    "description" => $description,
                    "image" => $image,
                    "category" => $category,
                    "demo_link" => $demo_link,
                    "code_link" => $code_link,
                    "tags" => explode(",", $tags)
                ];
                
                array_push($projects_arr["records"], $project_item);
            }
            
            return $projects_arr;
        } else {
            return ["message" => "No projects found for this category."];
        }
    }
}
?>