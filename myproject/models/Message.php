<?php
class Message {
    // Database connection and table name
    private $conn;
    private $table_name = "messages";

    // Object properties
    public $id;
    public $name;
    public $email;
    public $message;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create message
    public function create() {
        try {
            // Query to insert record
            $query = "INSERT INTO " . $this->table_name . " 
                      SET name=:name, email=:email, message=:message, created_at=:created_at";
            
            // Prepare query
            $stmt = $this->conn->prepare($query);
            
            // Sanitize data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->message = htmlspecialchars(strip_tags($this->message));
            $this->created_at = date('Y-m-d H:i:s');
            
            // Bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":message", $this->message);
            $stmt->bindParam(":created_at", $this->created_at);
            
            // Execute query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log the error
            file_put_contents(__DIR__ . '/../api/messages/debug_log.txt', "Model Error: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }

    // Validate message data
    public function validate() {
        $errors = [];
        
        if(empty($this->name)) {
            $errors[] = "Name is required";
        }
        
        if(empty($this->email)) {
            $errors[] = "Email is required";
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        if(empty($this->message)) {
            $errors[] = "Message is required";
        }
        
        return $errors;
    }
}
?>