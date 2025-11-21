<?php

namespace SFW\Routing;

/**
 * ルート管理
 * 
 * /test/{id} などの指定も可能
 */
class Router
{
    /** ルート定義 */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /** GETメソッドルーツ追加 */
    public function get(string $path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    /** POSTメソッドルーツ追加 */
    public function post(string $path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    /** 共通ルート追加処理 */
    private function addRoute(string $method, string $path, $handler)
    {
        // {param} を名前付きキャプチャのある正規表現に変換
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    /** 実行 */
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

    /** ハンドラーを実行 */
    private function runHandler($handler, $params)
    {
        [$class, $method] = $handler;
        $obj = new $class();
        return $obj->$method(...$params);
    }
}
