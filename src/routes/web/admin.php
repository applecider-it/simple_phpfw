<?php

/**
 * 管理画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\HomeController;
use App\Controllers\Admin\UserController;

$basePrefix = Config::get('app.adminPrefix');
$baseOptions = ['auth' => 'admin_user'];

$router->get($basePrefix, [HomeController::class, 'index'], $baseOptions + ['name' => 'admin.index']);

// ユーザー管理画面
(function ($router, $basePrefix, $baseOptions) {
    $prefix = $basePrefix . '/users';
    $controller = UserController::class;

    $router->get($prefix, [$controller, 'index'], $baseOptions + ['name' => 'admin.user.index']);
    $router->get($prefix . '/create', [$controller, 'create'], $baseOptions + ['name' => 'admin.user.create']);
    $router->post($prefix . '/create', [$controller, 'store'], $baseOptions);
    $router->get($prefix . '/{id}/edit', [$controller, 'edit'], $baseOptions + ['name' => 'admin.user.edit']);
    $router->post($prefix . '/{id}/edit', [$controller, 'update'], $baseOptions);
    $router->post($prefix . '/{id}/destroy', [$controller, 'destroy'], $baseOptions + ['name' => 'admin.user.destroy']);
    $router->post($prefix . '/{id}/restore', [$controller, 'restore'], $baseOptions + ['name' => 'admin.user.restore']);
})($router, $basePrefix, $baseOptions);
