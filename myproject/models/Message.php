<?php
class Message {
    private $conn;
    private $table_name = "messages";

    public $name;
    public $email;
    public $message;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validate() {
        $errors = [];
        if (empty($this->name)) $errors[] = 'Name is required';
        if (empty($this->email)) $errors[] = 'Email is required';
        if (empty($this->message)) $errors[] = 'Message is required';
        return $errors;
    }

    public function create() {
        
        try {
            $sql = "INSERT INTO {$this->table_name} (name, email, message, created_at) VALUES (:name, :email, :message, :created_at)";
            
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
              
                return false;
            }
            
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':created_at', $this->created_at);
            
            $result = $stmt->execute();
            if (!$result) {
               
            } else {
                
            }
            
            return $result;
        } catch (PDOException $e) {
            
            return false;
        }
    }
}