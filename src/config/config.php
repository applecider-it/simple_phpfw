<?php

/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応。多分、コンフリクトしやすいと思う。 */
$filePostfix = '20251209_0001';

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
            '@/services/app/application' => "/js/services/app/application.js?{$filePostfix}",
            '@/services/app/vue/app_common' => "/js/services/app/vue/app_common.js?{$filePostfix}",

            // 共通部分
            '@/services/data/json' => "/js/services/data/json.js?{$filePostfix}",
            '@/services/data/html' => "/js/services/data/html.js?{$filePostfix}",

            // 開発者向けページ用
            '@/services/development/setup_development' => "/js/services/development/setup_development.js?{$filePostfix}",
            '@/services/development/frontend_test' => "/js/services/development/frontend_test.js?{$filePostfix}",
            '@/services/development/vue/frontend_test_area' => "/js/services/development/vue/frontend_test_area.js?{$filePostfix}",
            '@/services/development/vue/frontend_test_area/form_component' => "/js/services/development/vue/frontend_test_area/form_component.js?{$filePostfix}",

            // チャットページ用
            '@/services/chat/chat_client' => "/js/services/chat/chat_client.js?{$filePostfix}",
            '@/services/chat/setup_chat' => "/js/services/chat/setup_chat.js?{$filePostfix}",
            '@/services/chat/vue/chat_area' => "/js/services/chat/vue/chat_area.js?{$filePostfix}",

            // ツイートページ用
            '@/services/tweet/tweet_client' => "/js/services/tweet/tweet_client.js?{$filePostfix}",
            '@/services/tweet/setup_tweet' => "/js/services/tweet/setup_tweet.js?{$filePostfix}",

            // UI
            '@/services/ui/message' => "/js/services/ui/message.js?{$filePostfix}",
            '@/services/ui/vue/message/loading' => "/js/services/ui/vue/message/loading.js?{$filePostfix}",
            '@/services/ui/vue/message/toasts' => "/js/services/ui/vue/message/toasts.js?{$filePostfix}",
            '@/services/ui/vue_hook/use_toast' => "/js/services/ui/vue_hook/use_toast.js?{$filePostfix}",

            // 外部ライブラリ
            '@/outer/vue3' => "https://unpkg.com/vue@3/dist/vue.esm-browser.prod.js?{$filePostfix}",
        ],
    ],

    // JWTシークレット
    'jwt_secret' => $env['SFW_JWT_SECRET'],

    // WebSocketサーバーのホスト名
    'ws_server_host' => $env['SFW_WS_SERVER_HOST'],
];
