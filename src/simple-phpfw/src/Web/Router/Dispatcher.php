<?php

declare(strict_types=1);

namespace SFW\Web\Router;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Web\Json;
use SFW\Web\Session;
use SFW\Web\Csrf;
use SFW\Web\Flash;
use SFW\Web\Router;

/**
 * ルートの実行管理
 */
class Dispatcher
{
    function __construct(
        private Router $router
    ) {}

    /** 実行 */
    public function dispatch(): mixed
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $prefix = Config::get('prefix');
        $uri = substr($uri, strlen($prefix));
        if ($uri === '') $uri = '/';

        $routes = $this->router->routes();

        foreach ($routes[$method] as $route) {
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
        $headers = getallheaders();

        $options = $route['options'];

        /** @var boolean セッションを利用しないときはtrue */
        $nosession = $options['nosession'] ?? false;

        $handler = $route['handler'];
        [$class, $method] = $handler;

        $this->router->setCurrentRoute($route);

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

        $csrfToken = $headers['X-CSRF-TOKEN'] ?? ($params['csrf_token'] ?? '');

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

                Csrf::check($csrfToken);
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
}
