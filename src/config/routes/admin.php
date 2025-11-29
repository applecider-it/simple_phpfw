<?php

/**
 * 管理画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\HomeController;
use App\Controllers\Admin\UserController;

$router->get(Config::get('adminPrefix'), [HomeController::class, 'index']);

// ユーザー管理画面
$router->get(Config::get('adminPrefix') . '/users', [UserController::class, 'index']);
$router->get(Config::get('adminPrefix') . '/users/create', [UserController::class, 'create']);
$router->post(Config::get('adminPrefix') . '/users/create', [UserController::class, 'store']);
$router->get(Config::get('adminPrefix') . '/users/{id}/edit', [UserController::class, 'edit']);
$router->post(Config::get('adminPrefix') . '/users/{id}/edit', [UserController::class, 'update']);
$router->post(Config::get('adminPrefix') . '/users/{id}/destroy', [UserController::class, 'destroy']);
$router->post(Config::get('adminPrefix') . '/users/{id}/restore', [UserController::class, 'restore']);
