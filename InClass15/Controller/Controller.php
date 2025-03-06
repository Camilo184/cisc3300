<?php

namespace Controller;

use Model\Post;

class Controller
{
    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getPosts();
        header('Content-Type: application/json');
        echo json_encode($posts);
    }
}
