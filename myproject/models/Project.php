<?php
class Project {
    // Database connection and table name
    private $conn;
    private $table_name = "projects";

    // Object properties
    public $id;
    public $title;
    public $description;
    public $image;
    public $category;
    public $demo_link;
    public $code_link;
    public $tags;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all projects
    public function read() {
        // Query to read all projects
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Execute query
        $stmt->execute();
        
        return $stmt;
    }

    // Read projects by category
    public function readByCategory($category) {
        // Query to read projects by category
        $query = "SELECT * FROM " . $this->table_name . " WHERE category = ? ORDER BY id DESC";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(1, $category);
        
        // Execute query
        $stmt->execute();
        
        return $stmt;
    }
}
?>