<?php

namespace inclass19\controllers;

use inclass19\models\User;

class UserController
{
    public function getUsers()
    {
        $userModel = new User();
        header("Content-Type: application/json");
        $query = !empty($_GET['name']) ? $_GET['name'] : null;
        $users = $userModel->getUsers($query);

        echo json_encode($users);
        exit();
    }
}

