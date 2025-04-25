<?php
class MessageController {
    private $db;
    private $message;

    public function __construct($db) {
        $this->db = $db;
        $this->message = new Message($db);
    }

    public function createMessage($data) {
        // Log the data for debugging
        $logFile = __DIR__ . '/../api/messages/debug_log.txt';
        file_put_contents($logFile, "MessageController received data: " . print_r($data, true) . "\n", FILE_APPEND);

        // Check if data is valid
        if (!is_object($data) && !is_array($data)) {
            file_put_contents($logFile, "Data is not an object or array\n", FILE_APPEND);
            return ['success' => false, 'error' => 'Invalid data format'];
        }

        // Extract data from either object or array
        $name = is_object($data) ? ($data->name ?? null) : ($data['name'] ?? null);
        $email = is_object($data) ? ($data->email ?? null) : ($data['email'] ?? null);
        $message = is_object($data) ? ($data->message ?? null) : ($data['message'] ?? null);

        // Log extracted values
        file_put_contents($logFile, "Extracted values - Name: $name, Email: $email, Message: " . substr($message, 0, 20) . "...\n", FILE_APPEND);

        // Check if required fields are present
        if (empty($name) || empty($email) || empty($message)) {
            file_put_contents($logFile, "Missing required fields\n", FILE_APPEND);
            return ['success' => false, 'error' => 'Missing required fields'];
        }

        // Set message properties
        $this->message->name = trim($name);
        $this->message->email = trim($email);
        $this->message->message = trim($message);
        $this->message->created_at = date('Y-m-d H:i:s');

        // Validate message
        $errors = $this->message->validate();
        if (!empty($errors)) {
            file_put_contents($logFile, "Validation errors: " . implode(', ', $errors) . "\n", FILE_APPEND);
            return ['success' => false, 'error' => implode(', ', $errors)];
        }

        // Create message
        if ($this->message->create()) {
            file_put_contents($logFile, "Message created successfully\n", FILE_APPEND);
            return ['success' => true];
        } else {
            file_put_contents($logFile, "Database insert failed\n", FILE_APPEND);
            return ['success' => false, 'error' => 'Database insert failed'];
        }
    }
}