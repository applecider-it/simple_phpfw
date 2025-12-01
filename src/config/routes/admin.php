<?php

/**
 * 管理画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\HomeController;
use App\Controllers\Admin\UserController;

$basePrefix = Config::get('adminPrefix');
$baseOptions = ['auth' => 'admin_user'];

$router->get($basePrefix, [HomeController::class, 'index'], $baseOptions);

// ユーザー管理画面
(function ($router, $basePrefix, $baseOptions) {
    $prefix = $basePrefix . '/users';
    $controller = UserController::class;

    $router->get($prefix, [$controller, 'index'], $baseOptions);
    $router->get($prefix . '/create', [$controller, 'create'], $baseOptions);
    $router->post($prefix . '/create', [$controller, 'store'], $baseOptions);
    $router->get($prefix . '/{id}/edit', [$controller, 'edit'], $baseOptions);
    $router->post($prefix . '/{id}/edit', [$controller, 'update'], $baseOptions);
    $router->post($prefix . '/{id}/destroy', [$controller, 'destroy'], $baseOptions);
    $router->post($prefix . '/{id}/restore', [$controller, 'restore'], $baseOptions);
})($router, $basePrefix, $baseOptions);
