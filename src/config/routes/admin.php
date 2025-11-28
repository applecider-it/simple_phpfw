<?php

/**
 * 管理画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\UserController as AdminUserController;


// ユーザー管理画面
$router->get(Config::get('adminPrefix') . '/users', [AdminUserController::class, 'index']);
$router->get(Config::get('adminPrefix') . '/users/create', [AdminUserController::class, 'create']);
$router->post(Config::get('adminPrefix') . '/users/create', [AdminUserController::class, 'store']);
$router->get(Config::get('adminPrefix') . '/users/{id}/edit', [AdminUserController::class, 'edit']);
$router->post(Config::get('adminPrefix') . '/users/{id}/edit', [AdminUserController::class, 'update']);
$router->post(Config::get('adminPrefix') . '/users/{id}/destroy', [AdminUserController::class, 'destroy']);
