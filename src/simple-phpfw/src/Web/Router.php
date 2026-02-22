<?php

declare(strict_types=1);

namespace SFW\Web;

use SFW\Core\App;

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
    private ?array $currentRoute = null;

    /** ルート定義を返す */
    public function routes(): array
    {
        return $this->routes;
    }

    /** GETメソッドルーツ追加 */
    public function get(string $path, $handler, array $options = []): void
    {
        $this->addRoute('GET', $path, $handler, $options);
    }

    /** POSTメソッドルーツ追加 */
    public function post(string $path, $handler, array $options = []): void
    {
        $this->addRoute('POST', $path, $handler, $options);
    }

    /** 共通ルート追加処理 */
    private function addRoute(string $method, string $path, $handler, array $options = []): void
    {
        // {param} を名前付きキャプチャのある正規表現に変換
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'path' => $path,
            'pattern' => $pattern,
            'handler' => $handler,
            'options' => $options,
        ];
    }

    /** 実行 */
    public function dispatch(): mixed
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // ルートが一致したとき

                // パラメータ（名前付きキャプチャのみ取り出す）
                $params = array_filter(
                    $matches,
                    fn($k) => !is_int($k),
                    ARRAY_FILTER_USE_KEY
                );

                return $this->runHandler($method, $route, $params);
            }
        }

        throw new \SFW\Exceptions\NotFound;
    }

    /**
     * ハンドラーを実行
     * 
     * 下記の分岐が複雑に絡んでいる。
     * 
     * ・HTMLとJSONの分岐。
     * ・セッションありなしの分岐。
     * ・GET、それ以外の分岐。
     */
    private function runHandler($requestMethod, array $route, array $urlParams): mixed
    {
        $options = $route['options'];

        /** @var boolean セッションを利用しないときはtrue */
        $nosession = $options['nosession'] ?? false;

        $handler = $route['handler'];
        [$class, $method] = $handler;

        $this->currentRoute = $route;

        $jsonData = [];
        $isJsonRequest = Json::isJsonRequest();

        // JSONパラメーターの処理
        if ($isJsonRequest && $requestMethod !== 'GET') {
            // JSONリクエストでGET以外の時

            $jsonData = Json::getJsonRequestData();
        }

        // 一番左が優先される
        $params = $urlParams + $_GET + $_POST + $jsonData;

        App::get('callback')->afterRequest($params);

        if (! $nosession) {
            // セッションを利用する時

            Session::start();

            App::get('callback')->afterStartSession();

            // CSRF処理
            if ($requestMethod === 'GET') {
                // GETメソッドの時

                if (! $isJsonRequest) {
                    // JSONリクエストじゃない時

                    Csrf::create();
                }
            } else {
                // POSTメソッドの時

                Csrf::check($params['csrf_token'] ?? '');
            }
        }

        $val =  $this->execController($class, $method, $params);

        if (! $nosession) {
            // セッションを利用する時

            Flash::clear();
        }

        if ($isJsonRequest) {
            // JSONリクエストの時

            Json::sendJsonHeader();
        }

        return $val;
    }

    /** コントローラーを実行 */
    private function execController($class, $method, array $params): mixed
    {
        /** @var \SFW\Web\Controller */
        $obj = new $class();

        $obj->params = $params;

        $obj->beforeAction();

        $val =  $obj->$method();

        return $val;
    }

    /** カレントのルート */
    public function currentRoute(): ?array
    {
        return $this->currentRoute;
    }
}
