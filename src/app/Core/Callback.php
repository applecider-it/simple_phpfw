<?php

namespace App\Core;

use SFW\Output\Log;
use SFW\Core\App;
use SFW\Core\Config;
use SFW\Data\Arr;
use SFW\Data\Str;

use App\Services\Nav\BreadcrumbsService;

use App\Services\User\AuthService;
use App\Services\AdminUser\AuthService as AdminAuthService;

/**
 * フレームワークからのコールバックを受け取る
 */
class Callback
{
    /** 初期化後。アプリケーションで利用するシングルトンの登録などをする。 */
    public function afterInit()
    {
        $authService = new AuthService();
        $adminAuthService = new AdminAuthService();

        Log::info('afterInit !!!!');

        $authService->initAuth();
        $adminAuthService->initAuth();

        App::getContainer()->setSingleton('breadcrumbs', new BreadcrumbsService(), 'パンくず');
        (function () {
            // include先で、$breadcrumbsが使われている
            $breadcrumbs = App::get('breadcrumbs');

            include(SFW_PROJECT_ROOT . '/config/breadcrumbs.php');
        })();
    }

    /** リクエスト情報取得直後 */
    public function afterRequest(array &$params)
    {
        // リクエストパラメーターを変更
        array_walk_recursive($params, function (&$item, $key) {
            if (is_string($item)) $item = Str::trimAll($item);
        });

        if (! Config::get('debug')) return;

        Log::info('afterRequest: route: ', App::get('router')->currentRoute());
        Log::info('afterRequest: params: ', Arr::maskRecursive($params, Config::get('app.trace_mask_keys')));

        $headers = getallheaders();
        Log::info('afterRequest: headers: ', Arr::maskRecursive(
            $headers,
            ['Cookie', 'User-Agent', 'sec-ch-ua', 'sec-ch-ua-mobile', 'sec-ch-ua-platform', 'X-CSRF-TOKEN']
        ));
    }

    /** セッションスタート直後 */
    public function afterStartSession()
    {
        if (! Config::get('debug')) return;

        Log::info('afterStartSession: $_SESSION: ', $_SESSION);
    }

    /** クエリー後 */
    public function afterQuery(string $sql, array $bindings, array $meta)
    {
        $message = "SQL" . ($meta['valid'] ? '' : ' Error!!!') . ": ";
        $message .= $sql;
        $message .= " (" . $meta['executionTime'] . ")";
        Log::info($message, $bindings);
    }

    /** ルーター処理後 */
    public function afterRouter(mixed $val)
    {
        // 連想配列の場合はJson
        if (is_array($val)) {
            echo json_encode($val);

            return;
        }

        // HTMLやテキスト出力
        echo $val;
    }
}
