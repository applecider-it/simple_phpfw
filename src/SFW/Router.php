<?php

namespace SFW;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, array $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        var_dump([
            '$method' => $method,
            '$uri' => $uri,
        ]);

        $handler = $this->routes[$method][$uri] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$className, $methodName] = $handler;

        $controller = new $className();
        echo $controller->$methodName();
    }
}
