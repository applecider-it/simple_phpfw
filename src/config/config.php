<?php

/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応。多分、コンフリクトしやすいと思う。 */
$filePostfix = '20251209_0000';

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
        'imports' => [
            // アプリケーションメイン
            '@/app' => "/js/app.js?{$filePostfix}",
            '@/services/app/setup_app' => "/js/services/app/setup_app.js?{$filePostfix}",

            // 共通部分
            '@/services/data/json' => "/js/services/data/json.js?{$filePostfix}",
            '@/services/data/html' => "/js/services/data/html.js?{$filePostfix}",

            // 開発者向けページ用
            '@/services/development/setup_development' => "/js/services/development/setup_development.js?{$filePostfix}",
            '@/services/development/frontend_test' => "/js/services/development/frontend_test.js?{$filePostfix}",

            // チャットページ用
            '@/services/chat/chat_client' => "/js/services/chat/chat_client.js?{$filePostfix}",
            '@/services/chat/setup_chat' => "/js/services/chat/setup_chat.js?{$filePostfix}",
            '@/services/chat/vue/chat_area' => "/js/services/chat/vue/chat_area.js?{$filePostfix}",

            // 外部ライブラリ
            '@/outer/vue3' => "https://unpkg.com/vue@3/dist/vue.esm-browser.js?{$filePostfix}",
        ],
    ],

    // JWTシークレット
    'jwt_secret' => $env['SFW_JWT_SECRET'],
];
