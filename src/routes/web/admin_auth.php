<?php

/**
 * 管理画面の認証画面のルート設定
 * 
 * @var SFW\Web\Router $router;
 */

use SFW\Core\Config;

use App\Controllers\Admin\Auth\SessionController;

$basePrefix = Config::get('app.adminPrefix');

$router->get($basePrefix . '/login', [SessionController::class, 'login'], ['name' => 'admin.login']);
$router->post($basePrefix . '/login', [SessionController::class, 'post']);
$router->post($basePrefix . '/logout', [SessionController::class, 'logout'], ['name' => 'admin.logout']);
