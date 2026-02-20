<?php

/**
 * インポートマップ情報
 */

// 共通
$commonList = [
    // アプリケーションメイン
    '@/services/app/application' => "/js/services/app/application.js?{$filePostfix}",
    '@/services/app/vue/app-common' => "/js/services/app/vue/app-common.js?{$filePostfix}",

    // 共通部分
    '@/services/data/json' => "/js/services/data/json.js?{$filePostfix}",
    '@/services/data/html' => "/js/services/data/html.js?{$filePostfix}",

    // UI
    '@/services/ui/message' => "/js/services/ui/message.js?{$filePostfix}",
    '@/services/ui/vue/message/loading' => "/js/services/ui/vue/message/loading.js?{$filePostfix}",
    '@/services/ui/vue/message/toasts' => "/js/services/ui/vue/message/toasts.js?{$filePostfix}",
    '@/services/ui/vue/popup/modal' => "/js/services/ui/vue/popup/modal.js?{$filePostfix}",
    '@/services/ui/vue-hook/use-toast' => "/js/services/ui/vue-hook/use-toast.js?{$filePostfix}",

    // 外部ライブラリ
    '@/outer/vue3' => "https://unpkg.com/vue@3/dist/vue.esm-browser.prod.js?{$filePostfix}",
];

// サイト用
$siteList = [
    // アプリケーションメイン
    '@/services/app/setup-app' => "/js/services/app/setup-app.js?{$filePostfix}",

    // 開発者向けページ用
    '@/services/development/setup-development' => "/js/services/development/setup-development.js?{$filePostfix}",
    '@/services/development/javascript-test' => "/js/services/development/javascript-test.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area' => "/js/services/development/vue/javascript-test-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/modal-area' => "/js/services/development/vue/javascript-test-area/modal-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/vue-model-area' => "/js/services/development/vue/javascript-test-area/vue-model-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/vue-model-area/form-component' => "/js/services/development/vue/javascript-test-area/vue-model-area/form-component.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/ui-area' => "/js/services/development/vue/javascript-test-area/ui-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/json-area' => "/js/services/development/vue/javascript-test-area/json-area.js?{$filePostfix}",
    '@/services/development/vue/javascript-test-area/form-area' => "/js/services/development/vue/javascript-test-area/form-area.js?{$filePostfix}",

    // チャットページ用
    '@/services/chat/chat-client' => "/js/services/chat/chat-client.js?{$filePostfix}",
    '@/services/chat/setup-chat' => "/js/services/chat/setup-chat.js?{$filePostfix}",
    '@/services/chat/vue/chat-area' => "/js/services/chat/vue/chat-area.js?{$filePostfix}",

    // ツイートページ用
    '@/services/tweet/tweet-client' => "/js/services/tweet/tweet-client.js?{$filePostfix}",
    '@/services/tweet/setup-tweet' => "/js/services/tweet/setup-tweet.js?{$filePostfix}",
];

// 管理画面用
$adminList = [
    // アプリケーションメイン
    '@/services/admin/app/setup-app' => "/js/services/admin/app/setup-app.js?{$filePostfix}",
];

return [
    'site' => [
        'imports' => $siteList + $commonList,
    ],
    'admin' => [
        'imports' => $adminList + $commonList,
    ]
];
