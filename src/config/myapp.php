<?php

/**
 * アプリケーション独自の設定
 */

// インポートマップ情報
$importmap = (fn($filePostfix) => include(__DIR__ . '/importmap.php'))($filePostfix);

return [
    // 複数DB実装例
    'database_another' => [
        'driver'   => $env['SFW_DATABASE_DRIVER'],
        'host'     => $env['SFW_DATABASE_HOST'],
        'database' => $env['SFW_DATABASE_DATABASE_ANOTHER'],
        'username' => $env['SFW_DATABASE_USERNAME'],
        'password' => $env['SFW_DATABASE_PASSWORD'],
        'charset'  => $env['SFW_DATABASE_CHARSET'],
    ],

    // 管理画面のprefix
    'adminPrefix' => '/admin_secret',

    // インポートマップ
    'importmap' => $importmap,

    // JWTシークレット
    'jwt_secret' => $env['SFW_JWT_SECRET'],

    // WebSocketサーバーのホスト名
    'ws_server_host' => $env['SFW_WS_SERVER_HOST'],

    // WebSocketサーバーのRedis連携名
    'ws_redis_relation_key' => 'websocket_publish',

    // トレースで隠すキーリスト
    'trace_mask_keys' => [
        'password',
        'password_confirm',
    ],
];
