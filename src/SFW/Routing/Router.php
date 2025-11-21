<?php

namespace SFW\Routing;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, $handler)
    {
        // {param} を正規表現に変換
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // パラメータ（名前付きキャプチャのみ取り出す）
                $params = array_filter(
                    $matches,
                    fn($k) => !is_int($k),
                    ARRAY_FILTER_USE_KEY
                );

                return $this->runHandler($route['handler'], $params);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function runHandler($handler, $params)
    {
        [$class, $method] = $handler;
        $obj = new $class();
        return $obj->$method(...$params);
    }
}
