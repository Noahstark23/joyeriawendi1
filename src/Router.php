<?php
namespace App;

class Router
{
    protected $routes = [];

    public function get(string $path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $path)
    {
        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        [$class, $action] = $handler;
        $controller = new $class();
        call_user_func([$controller, $action]);
    }
}
