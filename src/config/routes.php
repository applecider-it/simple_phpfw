<?php
/**
 * ルート設定
 */

use App\Controllers\HomeController;
use App\Controllers\DevlepmentController;

$router->get('/', [HomeController::class, 'index']);

$router->get('/devlepment', [DevlepmentController::class, 'index']);
$router->get('/devlepment/view_test', [DevlepmentController::class, 'view_test']);
$router->get('/devlepment/param_test/{id}', [DevlepmentController::class, 'param_test']);

