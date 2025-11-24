<?php
/**
 * ルート設定
 */

use App\Controllers\HomeController;
use App\Controllers\DevelopmentController;

// トップページ
$router->get('/', [HomeController::class, 'index']);

// 開発者向けページ
$router->get('/development', [DevelopmentController::class, 'index']);
$router->get('/development/view_test', [DevelopmentController::class, 'view_test']);
$router->get('/development/param_test/{id}', [DevelopmentController::class, 'param_test']);
$router->post('/development/param_test/{id}', [DevelopmentController::class, 'param_test']);
$router->get('/development/database_test', [DevelopmentController::class, 'database_test']);
$router->get('/development/validation_test', [DevelopmentController::class, 'validation_test']);
$router->get('/development/json_test', [DevelopmentController::class, 'json_test']);
$router->get('/development/redirect_test', [DevelopmentController::class, 'redirect_test'], ['name' => 'redirect_test']);

