<?php
class MessageController {
    private $db;
    private $message;

    public function __construct($db) {
        $this->db = $db;
        $this->message = new Message($db);
    }

    // Create a new message
    public function createMessage($data) {
        try {
            // Check if data is valid
            if (!isset($data->name) || !isset($data->email) || !isset($data->message)) {
                return [
                    "success" => false,
                    "error" => "Missing required fields"
                ];
            }
            
            // Set message property values
            $this->message->name = $data->name;
            $this->message->email = $data->email;
            $this->message->message = $data->message;
            
            // Validate message data
            $errors = $this->message->validate();
            
            if(!empty($errors)) {
                return [
                    "success" => false,
                    "error" => $errors
                ];
            }
            
            // Create the message
            if($this->message->create()) {
                return [
                    "success" => true,
                    "message" => "Message was created."
                ];
            } else {
                return [
                    "success" => false,
                    "error" => "Unable to create message."
                ];
            }
        } catch (Exception $e) {
            // Log the error
            file_put_contents(__DIR__ . '/../api/messages/debug_log.txt', "Controller Error: " . $e->getMessage() . "\n", FILE_APPEND);
            
            return [
                "success" => false,
                "error" => "An error occurred: " . $e->getMessage()
            ];
        }
    }
}
?>