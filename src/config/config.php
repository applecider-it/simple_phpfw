<?php

/**
 * アプリケーション設定
 */

/** @var string ブラウザキャッシュ対応。多分、コンフリクトしやすいと思う。 */
$filePostfix = '20260204_0000';

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
            '@/services/app/setup-app' => "/js/services/app/setup-app.js?{$filePostfix}",
            '@/services/app/application' => "/js/services/app/application.js?{$filePostfix}",
            '@/services/app/vue/app-common' => "/js/services/app/vue/app-common.js?{$filePostfix}",

            // 共通部分
            '@/services/data/json' => "/js/services/data/json.js?{$filePostfix}",
            '@/services/data/html' => "/js/services/data/html.js?{$filePostfix}",

            // 開発者向けページ用
            '@/services/development/setup-development' => "/js/services/development/setup-development.js?{$filePostfix}",
            '@/services/development/javascript-test' => "/js/services/development/javascript-test.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area' => "/js/services/development/vue/javascript-test-area.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area/modal-area' => "/js/services/development/vue/javascript-test-area/modal-area.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area/vue-model-area' => "/js/services/development/vue/javascript-test-area/vue-model-area.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area/vue-model-area/form-component' => "/js/services/development/vue/javascript-test-area/vue-model-area/form-component.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area/ui-area' => "/js/services/development/vue/javascript-test-area/ui-area.js?{$filePostfix}",
            '@/services/development/vue/javascript-test-area/json-area' => "/js/services/development/vue/javascript-test-area/json-area.js?{$filePostfix}",

            // チャットページ用
            '@/services/chat/chat-client' => "/js/services/chat/chat-client.js?{$filePostfix}",
            '@/services/chat/setup-chat' => "/js/services/chat/setup-chat.js?{$filePostfix}",
            '@/services/chat/vue/chat-area' => "/js/services/chat/vue/chat-area.js?{$filePostfix}",

            // ツイートページ用
            '@/services/tweet/tweet-client' => "/js/services/tweet/tweet-client.js?{$filePostfix}",
            '@/services/tweet/setup-tweet' => "/js/services/tweet/setup-tweet.js?{$filePostfix}",

            // UI
            '@/services/ui/message' => "/js/services/ui/message.js?{$filePostfix}",
            '@/services/ui/vue/message/loading' => "/js/services/ui/vue/message/loading.js?{$filePostfix}",
            '@/services/ui/vue/message/toasts' => "/js/services/ui/vue/message/toasts.js?{$filePostfix}",
            '@/services/ui/vue/popup/modal' => "/js/services/ui/vue/popup/modal.js?{$filePostfix}",
            '@/services/ui/vue-hook/use-toast' => "/js/services/ui/vue-hook/use-toast.js?{$filePostfix}",

            // 外部ライブラリ
            '@/outer/vue3' => "https://unpkg.com/vue@3/dist/vue.esm-browser.prod.js?{$filePostfix}",
        ],
    ],

    // JWTシークレット
    'jwt_secret' => $env['SFW_JWT_SECRET'],

    // WebSocketサーバーのホスト名
    'ws_server_host' => $env['SFW_WS_SERVER_HOST'],

    // WebSocketサーバーのRedis連携名
    'ws_redis_relation_key' => 'websocket_publish',
];
