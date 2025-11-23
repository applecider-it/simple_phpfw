<?php

namespace App\Core;

use SFW\Output\Log;

/**
 * フレームワークからのコールバックを受け取る
 */
class Callback
{
    /** 初期化後 */
    public function afterInit()
    {
        Log::info('afterInit !!!!');
    }

    /** クエリー後 */
    public function afterQuery(string $sql, array $bindings)
    {
        Log::info($sql, $bindings);
    }
}
