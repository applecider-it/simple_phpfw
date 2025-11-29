<?php

namespace App\Core;

use SFW\Output\Log;
use SFW\Core\App;

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
        App::getContainer()->setSingleton('user', null);

        // 管理画面のログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton('adminUser', null);
    }

    /** クエリー後 */
    public function afterQuery(string $sql, array $bindings, array $meta)
    {
        $message = "SQL" . ($meta['valid'] ? '' : ' Error!!!') . ": ";
        $message .= $sql;
        $message .= " (" . bcdiv($meta['executionTime'], 1, 5) . ")";
        Log::info($message, $bindings);
    }
}
