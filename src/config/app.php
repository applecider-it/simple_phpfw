<?php

/**
 * アプリケーション独自の設定
 */

return [
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

    // トレースで隠すキーリスト
    'trace_mask_keys' => [
        'password',
        'password_confirm',
    ],
];
