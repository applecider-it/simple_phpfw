<?php

namespace App\Services\WebSocket;

use App\Services\Core\System;
use App\Services\WebSocket\Server;

/**
 * WebSocketサーバーセットアップ
 */
class Setup
{
    /**
     * 実行
     */
    public static function exec()
    {
        $config = System::loadConfig();

        $server = new Server($config);
        $server->start();
    }
}
