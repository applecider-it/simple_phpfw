<?php
/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応 */
$importmapUpdate = '20251202_0001';

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

    // 管理画面のprefix
    'adminPrefix' => '/admin_secret',

    // インポートマップ
    'importmap' => [
        'imports' => [
            '@/app' => "/js/app.js?update={$importmapUpdate}",

            '@/services/data/json' => "/js/services/data/json.js?update={$importmapUpdate}",

            // 開発者向けページ用
            '@/services/development/setup_development' => "/js/services/development/setup_development.js?update={$importmapUpdate}",
            '@/services/development/frontend_test' => "/js/services/development/frontend_test.js?update={$importmapUpdate}",
        ],
    ]
];