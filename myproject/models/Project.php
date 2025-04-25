<?php
class Project {
    private $conn;
    private $table_name = "projects";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProjects() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectsByCategory($category) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>