<?php

namespace App\Core;

use SFW\Output\Log;
use SFW\Core\App;
use SFW\Core\Config;
use SFW\Database\DB;

/**
 * フレームワークからのコールバックを受け取る
 */
class Callback
{
    /** 初期化後。アプリケーションで利用するシングルトンの登録などをする。 */
    public function afterInit()
    {
        Log::info('afterInit !!!!');

        // ログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton('user', null, 'ログインユーザー');

        // 管理画面のログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton('adminUser', null, '管理画面のログインユーザー');

        // 複数DB実装例
        $db_another = new DB(Config::get('database_another'));
        App::getContainer()->setSingleton('db_another', $db_another, '複数DB実装例');
    }

    /** リクエスト情報取得直後 */
    public function afterRequest(array $params)
    {
        if (! Config::get('debug')) return;

        Log::info('afterRequest: route: ', App::get('router')->currentRoute());
        Log::info('afterRequest: params: ', $params);
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
        $message .= " (" . bcdiv($meta['executionTime'], 1, 5) . ")";
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
