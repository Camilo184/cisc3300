<?php

namespace inclass19\models;

use PDO;
use PDOException;

abstract class Model {

    private function connect() {
//      dsn: data source name
//      some of these are optional
       
$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;

        $options = [
            //we can set the error mode, to throw exceptions or PDO type errors
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //set the default fetch type to associative array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO($dsn, DBUSER, DBPASS, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }

    }

    public function fetchAll($query) {
        $connectedPDO = $this->connect();
        $statementObject = $connectedPDO->query($query);
        //no params, multiple rows
        return $statementObject->fetchAll();
    }

    public function fetchAllWithParams($query, $data = []) {
        $connection = $this->connect();
        //prepare statement - a query with any dynamic data subbed out with variables like :firstName
        $statementObject = $connection->prepare($query);
        //data is an associative array with key value pairs matching any params in the query
        $successOrFail = $statementObject->execute($data);
        if ($successOrFail) {
            $result = $statementObject->fetchAll();
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }

}