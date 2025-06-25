<?php
namespace App;

class Router
{
    protected array $routes = [];

    public function get(string $path, $handler): void
    {
        $this->routes['GET'][] = $this->parseRoute($path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->routes['POST'][] = $this->parseRoute($path, $handler);
    }

    protected function parseRoute(string $path, $handler): array
    {
        $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        preg_match_all('#\{([^}]+)\}#', $path, $matches);
        return [
            'pattern' => $pattern,
            'params'  => $matches[1],
            'handler' => $handler,
        ];
    }

    public function dispatch(string $method, string $path): void
    {
        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $path, $matches)) {
                array_shift($matches);
                $params = [];
                foreach ($route['params'] as $i => $name) {
                    $params[$name] = $matches[$i] ?? null;
                }
                $handler = $route['handler'];
                if (is_callable($handler)) {
                    $handler($params);
                } else {
                    [$class, $action] = $handler;
                    $controller = new $class();
                    call_user_func([$controller, $action], $params);
                }
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
