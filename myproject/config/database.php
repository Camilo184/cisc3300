<?php
class Database {
    private $host = "localhost";
    private $db_name = "portfolio_db";
    private $username = "root";
    private $password = "root";
    public $conn;

    // Get database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            return $this->conn;
        } catch(PDOException $exception) {
            // Log the error
            file_put_contents(__DIR__ . '/../api/messages/debug_log.txt', "DB Connection Error: " . $exception->getMessage() . "\n", FILE_APPEND);
            return null;
        }
    }
}
?>