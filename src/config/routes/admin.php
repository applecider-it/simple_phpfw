<?php

/**
 * 管理画面のルート設定
 */

use SFW\Core\Config;

use App\Controllers\Admin\HomeController;
use App\Controllers\Admin\UserController;

$router->get(Config::get('adminPrefix'), [HomeController::class, 'index'], ['auth' => 'admin_user']);

// ユーザー管理画面
$router->get(Config::get('adminPrefix') . '/users', [UserController::class, 'index'], ['auth' => 'admin_user']);
$router->get(Config::get('adminPrefix') . '/users/create', [UserController::class, 'create'], ['auth' => 'admin_user']);
$router->post(Config::get('adminPrefix') . '/users/create', [UserController::class, 'store'], ['auth' => 'admin_user']);
$router->get(Config::get('adminPrefix') . '/users/{id}/edit', [UserController::class, 'edit'], ['auth' => 'admin_user']);
$router->post(Config::get('adminPrefix') . '/users/{id}/edit', [UserController::class, 'update'], ['auth' => 'admin_user']);
$router->post(Config::get('adminPrefix') . '/users/{id}/destroy', [UserController::class, 'destroy'], ['auth' => 'admin_user']);
$router->post(Config::get('adminPrefix') . '/users/{id}/restore', [UserController::class, 'restore'], ['auth' => 'admin_user']);
