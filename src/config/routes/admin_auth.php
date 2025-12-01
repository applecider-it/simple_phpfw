<?php

/**
 * 管理画面の認証画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\Auth\SessionController;

$basePrefix = Config::get('adminPrefix');

$router->get($basePrefix . '/login', [SessionController::class, 'login']);
$router->post($basePrefix . '/login', [SessionController::class, 'post']);
$router->get($basePrefix . '/logout', [SessionController::class, 'logout']);
