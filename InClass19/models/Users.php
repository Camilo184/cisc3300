<?php

namespace inclass19\models;

class User extends Model {

    public function getUsers($name) {
        if ($name) {
            $query = "select * from posts WHERE name like :name";
            return $this->fetchAllWithParams($query, ['name' => '%' . $name . '%']);
        }
        $query = "select * from posts";
        return $this->fetchAll($query);
    }
}

