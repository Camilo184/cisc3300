<?php
session_start();

require_once 'config.php';


require_once 'controllers/ProductController.php';

$controller = new ProductController($conn);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'search':
        $controller->search();
        break;
    default:
        $controller->index();
        break;
}
?>
