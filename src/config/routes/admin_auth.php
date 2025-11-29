<?php

/**
 * 管理画面の認証画面のルート設定
 */

 use SFW\Core\Config;

use App\Controllers\Admin\Auth\SessionController;

$router->get(Config::get('adminPrefix') . '/login', [SessionController::class, 'login']);
$router->post(Config::get('adminPrefix') . '/login', [SessionController::class, 'post']);
$router->get(Config::get('adminPrefix') . '/logout', [SessionController::class, 'logout']);
