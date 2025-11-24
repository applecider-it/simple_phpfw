<?php
/**
 * ルート設定
 */

use App\Controllers\HomeController;
use App\Controllers\DevlepmentController;

// トップページ
$router->get('/', [HomeController::class, 'index']);

// 開発者向けページ
$router->get('/devlepment', [DevlepmentController::class, 'index']);
$router->get('/devlepment/view_test', [DevlepmentController::class, 'view_test']);
$router->get('/devlepment/param_test/{id}', [DevlepmentController::class, 'param_test']);
$router->get('/devlepment/database_test', [DevlepmentController::class, 'database_test']);
$router->get('/devlepment/validation_test', [DevlepmentController::class, 'validation_test']);
$router->get('/devlepment/json_test', [DevlepmentController::class, 'json_test']);
$router->get('/devlepment/redirect_test', [DevlepmentController::class, 'redirect_test'], ['name' => 'redirect_test']);

