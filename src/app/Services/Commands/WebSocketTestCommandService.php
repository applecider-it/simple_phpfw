<?php

namespace App\Services\Commands;

use SFW\Core\App;
use SFW\Data\Json;

use App\Services\WebSocket\SystemService;

/**
 *  WebSocketの動作確認コマンド用サービス
 */
class WebSocketTestCommandService
{
    public function exec(array $params, array $options)
    {
        echo "Begin WebSocketTestCommandService\n";

        $systemService = new SystemService;
        $systemService->publish('chat:', [
            'message' => 'From System (Redis) ' . date('Y/m/d H:i:s'),
        ]);
    }
}
