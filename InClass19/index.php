<?php
require_once "../InClass19/models/model.php";
require_once "../InClass19/models/Users.php";
require_once "../InClass19/controllers/UserControllers.php";

//set our env variables, remember con
$env = parse_ini_file('../InClass19/.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

use inclass19\controllers\UserController;

//get uri without query strings
$uri = strtok($_SERVER["REQUEST_URI"], '?');

//get uri pieces
$uriArray = explode("/", $uri);

if ($uriArray[1] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'GET') {

    $userController = new UserController();
    $userController->getUsers();

}

exit();