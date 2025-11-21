<?php
/**
 * システム全般の最初のセットアップ
 */

// 開発用にエラー表示している
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** プロジェクトルート（SFWで必要な定数） */
define('SFW_PROJECT_ROOT', dirname(__DIR__));

require SFW_PROJECT_ROOT . '/vendor/autoload.php';
