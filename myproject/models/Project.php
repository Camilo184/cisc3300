<?php
class Project {
    private $conn;
    private $table_name = 'projects';
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all projects
    public function readAll() {
        $stmt = $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
