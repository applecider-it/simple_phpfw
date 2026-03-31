<?php

/**
 * アプリケーション独自の設定
 */

return [
    // 管理画面のprefix
    'adminPrefix' => '/admin_secret',

    // トレースで隠すキーリスト
    'trace_mask_keys' => [
        'password',
        'password_confirm',
    ],
];
