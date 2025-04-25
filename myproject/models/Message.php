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
        // Log for debugging
        $logFile = __DIR__ . '/../api/messages/message_model_log.txt';
        file_put_contents($logFile, "--------- Create Method Called ---------\n", FILE_APPEND);
        file_put_contents($logFile, "Name: {$this->name}\n", FILE_APPEND);
        file_put_contents($logFile, "Email: {$this->email}\n", FILE_APPEND);
        file_put_contents($logFile, "Message: {$this->message}\n", FILE_APPEND);
        file_put_contents($logFile, "Created At: {$this->created_at}\n", FILE_APPEND);
        
        try {
            $sql = "INSERT INTO {$this->table_name} (name, email, message, created_at) VALUES (:name, :email, :message, :created_at)";
            file_put_contents($logFile, "SQL: {$sql}\n", FILE_APPEND);
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                file_put_contents($logFile, "Prepare failed: " . implode(", ", $this->conn->errorInfo()) . "\n", FILE_APPEND);
                return false;
            }
            
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':created_at', $this->created_at);
            
            $result = $stmt->execute();
            if (!$result) {
                file_put_contents($logFile, "Execute failed: " . implode(", ", $stmt->errorInfo()) . "\n", FILE_APPEND);
            } else {
                file_put_contents($logFile, "Insert successful\n", FILE_APPEND);
            }
            
            return $result;
        } catch (PDOException $e) {
            file_put_contents($logFile, "Exception: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }
}