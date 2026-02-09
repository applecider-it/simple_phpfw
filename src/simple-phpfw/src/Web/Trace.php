<?php

namespace SFW\Web;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\StdOut;
use SFW\Output\Log;

/**
 * トレース管理
 */
class Trace
{
    /** ルート情報を標準出力 */
    public static function outputRoutes(bool $includeOptions): void
    {
        $router = App::get('router');

        $routes = $router->routes();

        $header = [
            '',
            'Path',
            'Handler',
        ];

        if ($includeOptions) $header[] = 'Options';

        $rows = [];
        foreach ($routes as $method => $methodRoutes) {
            foreach ($methodRoutes as $route) {
                $row = [
                    'method' => $method,
                    'path' => $route['path'],
                    'handler' => implode('::', $route['handler']),
                ];

                if ($includeOptions) $row['options'] = json_encode($route['options'], JSON_UNESCAPED_UNICODE);

                $rows[] = $row;
            }
        }

        // パスの昇順、メソッドの昇順でソート
        $paths = array_column($rows, 'path');
        $methods = array_column($rows, 'method');
        array_multisort($paths, SORT_ASC, $methods, SORT_ASC, $rows);

        StdOut::table([$header, ...$rows]);
    }
}
