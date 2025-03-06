<?php

namespace Model;

class Post
{
    public function getPosts()
    {
        return [
            ['title' => 'First Post', 'description' => 'Hello this is my first ever post'],
            ['title' => 'Second Post', 'description' => 'second post'],
            ['title' => 'Third Post', 'description' => 'My third and last post']
        ];
    }
}
