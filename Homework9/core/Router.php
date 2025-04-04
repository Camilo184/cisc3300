<?php
class Router {
    private $routes = [];

    public function addRoute($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch() {
        $route = $_GET['route'] ?? 'home';
        if (isset($this->routes[$route])) {
            $controllerName = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];
            $controller = new $controllerName();
            $controller->$method();
        } else {
            echo "Page not found";
        }
    }
}