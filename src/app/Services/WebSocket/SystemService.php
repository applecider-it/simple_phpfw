<?php

namespace App\Services\WebSocket;

use SFW\Core\App;

/**
 * WebSocketのシステム管理
 */
class SystemService
{
    public function __construct() {}

    /**
     * RedisにWebSocketサーバー連携情報出力
     * 
     * PHPのWebSocketサーバーなのでpublishじゃなくてrPushで代用している。
     */
    public function publish(string $channel, array $data)
    {
        $sendData = [
            'channel' => $channel,
            'data' => $data,
        ];

        $redis = App::get('redis');

        $redis->rPush('websocket_publish', json_encode($sendData));
    }
}
