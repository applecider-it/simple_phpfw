<?php

/**
 * アプリケーション設定
 * 
 * 別ファイルにある設定は、ローカル変数を保護するためクロージャで囲って、読み込んでいる
 */

/** @var string ブラウザキャッシュ対応。多分、コンフリクトしやすいと思う。 */
$filePostfix = '20260204_0000';

// アプリケーション独自の設定
$app = (fn($env, $filePostfix) => include(__DIR__ . '/app.php'))($env, $filePostfix);

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

    // ブラウザキャッシュ対応
    'filePostfix' => $filePostfix,

    // アプリケーション独自の設定
    'app' => $app,
];
