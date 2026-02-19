<?php

/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応。多分、コンフリクトしやすいと思う。 */
$filePostfix = '20260204_0000';

// ローカル変数を保護するためクロージャで囲って、インポートマップ情報を読み込む
[$importmapImports, $importmapAdminImports] = (fn ($filePostfix) => include(__DIR__ . '/importmap.php'))($filePostfix);

return [
    'debug' => $env['SFW_DEBUG'],

    // アプリケーション名
    'applicationName' => 'Simple PHPFW Project',

    'lang' => 'ja',

    'database' => [
        'driver'   => $env['SFW_DATABASE_DRIVER'],
        'host'     => $env['SFW_DATABASE_HOST'],
        'database' => $env['SFW_DATABASE_DATABASE'],
        'username' => $env['SFW_DATABASE_USERNAME'],
        'password' => $env['SFW_DATABASE_PASSWORD'],
        'charset'  => $env['SFW_DATABASE_CHARSET'],
    ],

    'redis' => [
        'host'     => $env['SFW_REDIS_HOST'],
        'port'     => $env['SFW_REDIS_PORT'],
    ],

    'logging' => [
        'web' => [
            'file' => 'php://stderr',
        ],
        'console' => [
            'file' => SFW_PROJECT_ROOT . '/storage/logs/simple_framework.log',
        ],
    ],

    'session' => [
        'lifetime' => 60 * 60 * 24 * 30,
        'save_path' => SFW_PROJECT_ROOT . '/storage/session',
        'name' => "SFWSESSIONID",
    ],

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

    // ブラウザキャッシュ対応
    'filePostfix' => $filePostfix,

    // インポートマップ
    'importmap' => [
        'imports' => $importmapImports,
    ],
    'importmapAdmin' => [
        'imports' => $importmapAdminImports,
    ],

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
