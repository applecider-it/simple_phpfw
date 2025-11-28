<?php

namespace SFW\Routing;

use SFW\Core\App;
use SFW\Output\StdOut;

/**
 * トレース管理
 */
class Trace
{
    /** ルート情報を標準出力 */
    public static function outputRoutes() {
        $router = App::get('router');

        $routes = $router->routes();

        $header = [
            'Method',
            'Path',
            'Handler',
            'Options',
        ];

        $rows = [];
        foreach ($routes as $method => $methodRoutes) {
            foreach ($methodRoutes as $route) {
                $rows[] = [
                    'method' => $method,
                    'path' => $route['path'],
                    'handler' => implode('::', $route['handler']),
                    'options' => json_encode($route['options'], JSON_UNESCAPED_UNICODE),
                ];
            }
        }

        // パスの昇順、メソッドの昇順でソート
        $paths = array_column($rows, 'path');
        $methods = array_column($rows, 'method');
        array_multisort($paths, SORT_ASC, $methods, SORT_ASC, $rows);

        StdOut::table([$header, ...$rows]);
    }
}
