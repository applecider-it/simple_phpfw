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

    /** カレントのルート */
    public $currentRoute = null;

    /** GETメソッドルーツ追加 */
    public function get(string $path, $handler, array $options = [])
    {
        $this->addRoute('GET', $path, $handler, $options);
    }

    /** POSTメソッドルーツ追加 */
    public function post(string $path, $handler, array $options = [])
    {
        $this->addRoute('POST', $path, $handler, $options);
    }

    /** 共通ルート追加処理 */
    private function addRoute(string $method, string $path, $handler, array $options = [])
    {
        // {param} を名前付きキャプチャのある正規表現に変換
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'handler' => $handler,
            'options' => $options,
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

                return $this->runHandler($route, $params);
            }
        }

        throw new \SFW\Exceptions\NotFound;
    }

    /** ハンドラーを実行 */
    private function runHandler(array $route, array $params)
    {
        $handler = $route['handler'];
        [$class, $method] = $handler;

        $this->currentRoute = $route;

        /** @var \SFW\Routing\Controller */
        $obj = new $class();

        // 一番左が優先される
        $obj->params = $params + $_GET + $_POST;

        $obj->beforeAction();

        return $obj->$method();
    }
}
