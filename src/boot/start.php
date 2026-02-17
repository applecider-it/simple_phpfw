<?php

/**
 * システム全般の最初のセットアップ
 */

// すべてのエラーが対象
error_reporting(E_ALL);

// エラーを例外にする
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

/** プロジェクトルート（SFWで必要な定数） */
define('SFW_PROJECT_ROOT', dirname(__DIR__));

(new SFW\Boot\Common)->init();
