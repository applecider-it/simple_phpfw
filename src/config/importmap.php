<?php

/**
 * インポートマップ情報
 */

// 共通
$commonList = [
    // アプリケーションメイン
    '@/services/app/vue/app-common' => $prefix . "/js/services/app/vue/app-common.js?{$filePostfix}",

    // 共通部分
    '@/services/api/rest' => $prefix . "/js/services/api/rest.js?{$filePostfix}",
    '@/services/data/json' => $prefix . "/js/services/data/json.js?{$filePostfix}",
    '@/services/data/html' => $prefix . "/js/services/data/html.js?{$filePostfix}",

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
    '@/services/development/vue/javascript-test-area/json-area' => $prefix . "/js/services/development/vue/javascript-test-area/json-area.js?{$filePostfix}",
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
