<?php
class Controller {
    public function index() {
        require 'view.php';
    }

    public function store() {
        $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
        $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';

        $errors = [];

        if (strlen($title) <= 3) {
            $errors[] = "Title must be more than 3 characters.";
        }

        if (strlen($description) <= 10) {
            $errors[] = "Description must be more than 10 characters.";
        }

        if (!empty($errors)) {
            require 'view.php';
            return;
        }

        $successMessage = "Note added successfully!";
        require 'view.php';
    }
}
?>
