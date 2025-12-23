<?php

use App\Services\Core\Env;

/**
 * 設定
 */

$env = Env::load(dirname(dirname(__DIR__)) . '/.env');

return [
    // WebSocketサーバーのRedis連携名
    'ws_redis_relation_key' => 'websocket_publish',

    'redis' => [
        'host' => $env['SFW_REDIS_HOST'],
        'port' => $env['SFW_REDIS_PORT'],
    ],

    'ws_server' => [
        'host' => $env['SFW_WS_SERVER_HOST'],
        'port' => $env['SFW_WS_SERVER_PORT'],
    ],

    'jwt_secret' => $env['SFW_JWT_SECRET'],
];
