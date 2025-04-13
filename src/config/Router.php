<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path)) {
                $params = $this->extractParams($route['path'], $path);
                $controller = new $route['controller']();
                call_user_func_array([$controller, $route['action']], $params);
                return;
            }
        }

        // Route non trouvée
        header("HTTP/1.0 404 Not Found");
        require_once 'src/views/errors/404.php';
    }

    private function matchPath($routePath, $requestPath) {
        $routeParts = explode('/', trim($routePath, '/'));
        $requestParts = explode('/', trim($requestPath, '/'));

        if (count($routeParts) !== count($requestParts)) {
            return false;
        }

        for ($i = 0; $i < count($routeParts); $i++) {
            if ($routeParts[$i] !== $requestParts[$i] && !preg_match('/^{.+}$/', $routeParts[$i])) {
                return false;
            }
        }

        return true;
    }

    private function extractParams($routePath, $requestPath) {
        $params = [];
        $routeParts = explode('/', trim($routePath, '/'));
        $requestParts = explode('/', trim($requestPath, '/'));

        for ($i = 0; $i < count($routeParts); $i++) {
            if (preg_match('/^{(.+)}$/', $routeParts[$i], $matches)) {
                $params[] = $requestParts[$i];
            }
        }

        return $params;
    }
} 