<?php

require_once 'core/Router.php';
require_once 'controllers/ProductController.php';

$router = new Router();
$router->addRoute('search', 'ProductController', 'search');
$router->dispatch();
