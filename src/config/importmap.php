<?php

/**
 * インポートマップ情報
 */

// 共通
$commonList = [
    // アプリケーションメイン
    '@/services/app/bootstrap/container' => $prefix . "/js/services/app/bootstrap/container.js?{$filePostfix}",
    '@/services/app/bootstrap/menu' => $prefix . "/js/services/app/bootstrap/menu.js?{$filePostfix}",
    '@/services/app/vue/app-common' => $prefix . "/js/services/app/vue/app-common.js?{$filePostfix}",

    // 共通部分
    '@/services/api/rest' => $prefix . "/js/services/api/rest.js?{$filePostfix}",
    '@/services/data/json' => $prefix . "/js/services/data/json.js?{$filePostfix}",
    '@/services/data/html' => $prefix . "/js/services/data/html.js?{$filePostfix}",

    // UI
    '@/services/ui/message' => $prefix . "/js/services/ui/message.js?{$filePostfix}",
    '@/services/ui/vue/message/loading' => $prefix . "/js/services/ui/vue/message/loading.js?{$filePostfix}",
    '@/services/ui/vue/message/loading-inline' => $prefix . "/js/services/ui/vue/message/loading-inline.js?{$filePostfix}",
    '@/services/ui/vue/message/toasts' => $prefix . "/js/services/ui/vue/message/toasts.js?{$filePostfix}",
    '@/services/ui/vue/popup/modal' => $prefix . "/js/services/ui/vue/popup/modal.js?{$filePostfix}",
    '@/services/ui/vue-hook/use-toast' => $prefix . "/js/services/ui/vue-hook/use-toast.js?{$filePostfix}",

    // 外部ライブラリ
    '@/outer/vue3' => "https://unpkg.com/vue@3/dist/vue.esm-browser.prod.js?{$filePostfix}",
];

// アプリケーション用
$appList = [
    // アプリケーションメイン
    '@/services/app/setup-app' => $prefix . "/js/services/app/setup-app.js?{$filePostfix}",
    '@/services/app/application' => $prefix . "/js/services/app/application.js?{$filePostfix}",

    // 開発者向けページ用
    '@/services/development/setup-development' => $prefix . "/js/services/development/setup-development.js?{$filePostfix}",
    '@/services/development/javascript-test' => $prefix . "/js/services/development/javascript-test.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area' => $prefix . "/js/services/development/vue/javascript-test-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/modal-area' => $prefix . "/js/services/development/vue/javascript-test-area/modal-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/vue-model-area' => $prefix . "/js/services/development/vue/javascript-test-area/vue-model-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/vue-model-area/form-component' => $prefix . "/js/services/development/vue/javascript-test-area/vue-model-area/form-component.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/ui-area' => $prefix . "/js/services/development/vue/javascript-test-area/ui-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/json-area' => $prefix . "/js/services/development/vue/javascript-test-area/json-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/form-area' => $prefix . "/js/services/development/vue/javascript-test-area/form-area.js?{$filePostfix}",

    // チャットページ用
    '@/services/chat/chat-client' => $prefix . "/js/services/chat/chat-client.js?{$filePostfix}",
    '@/services/chat/setup-chat' => $prefix . "/js/services/chat/setup-chat.js?{$filePostfix}",
    '@/services/chat/vue/chat-area' => $prefix . "/js/services/chat/vue/chat-area.js?{$filePostfix}",

    // ツイートページ用
    '@/services/tweet/tweet-client' => $prefix . "/js/services/tweet/tweet-client.js?{$filePostfix}",
    '@/services/tweet/setup-tweet' => $prefix . "/js/services/tweet/setup-tweet.js?{$filePostfix}",
    '@/services/tweet/vue/tweet-area' => $prefix . "/js/services/tweet/vue/tweet-area.js?{$filePostfix}",
];

// 管理画面用
$adminList = [
    // アプリケーションメイン
    '@/services/admin/app/setup-app' => $prefix . "/js/services/admin/app/setup-app.js?{$filePostfix}",
    '@/services/admin/app/application' => $prefix . "/js/services/admin/app/application.js?{$filePostfix}",
];

return [
    'app' => [
        'imports' => $appList + $commonList,
    ],
    'admin' => [
        'imports' => $adminList + $commonList,
    ]
];
