<?php
/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応 */
$filePostfix = '20251202_0002';

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

    // ブラウザキャッシュ対応
    'filePostfix' => $filePostfix,

    // インポートマップ
    'importmap' => [
        'imports' => [
            '@/app' => "/js/app.js?{$filePostfix}",

            '@/services/data/json' => "/js/services/data/json.js?{$filePostfix}",

            // 開発者向けページ用
            '@/services/development/setup_development' => "/js/services/development/setup_development.js?{$filePostfix}",
            '@/services/development/frontend_test' => "/js/services/development/frontend_test.js?{$filePostfix}",
        ],
    ]
];