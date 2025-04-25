<?php
class MessageController {
    private $db;
    private $message;

    public function __construct($db) {
        $this->db = $db;
        $this->message = new Message($db);
    }

    public function createMessage($data) {
       
        if (!is_object($data) && !is_array($data)) {
            return ['success' => false, 'error' => 'Invalid data format'];
        }

        $name = is_object($data) ? ($data->name ?? null) : ($data['name'] ?? null);
        $email = is_object($data) ? ($data->email ?? null) : ($data['email'] ?? null);
        $message = is_object($data) ? ($data->message ?? null) : ($data['message'] ?? null);


        if (empty($name) || empty($email) || empty($message)) {
            return ['success' => false, 'error' => 'Missing required fields'];
        }

        $this->message->name = trim($name);
        $this->message->email = trim($email);
        $this->message->message = trim($message);
        $this->message->created_at = date('Y-m-d H:i:s');

        $errors = $this->message->validate();
        if (!empty($errors)) {
            return ['success' => false, 'error' => implode(', ', $errors)];
        }

        if ($this->message->create()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Database insert failed'];
        }
    }
}