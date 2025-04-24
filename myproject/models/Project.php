<?php
require_once '../config/database.php';

class Project {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllProjects() {
        $stmt = $this->conn->prepare("SELECT * FROM projects");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
