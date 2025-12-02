<?php

/**
 * ルート設定
 * 
 * クロージャーで囲うことで、ローカル変数を保護している。
 */

use App\Controllers\HomeController;
use App\Controllers\DevelopmentController;

// トップページ
$router->get('/', [HomeController::class, 'index']);

// 開発者向けページ
(function ($router) {
    $prefix = '/development';
    $controller = DevelopmentController::class;

    $router->get($prefix, [$controller, 'index']);
    $router->get($prefix . '/view_test', [$controller, 'view_test']);
    $router->get($prefix . '/param_test/{id}', [$controller, 'param_test']);
    $router->post($prefix . '/param_test/{id}', [$controller, 'param_test']);
    $router->get($prefix . '/database_test', [$controller, 'database_test']);
    $router->get($prefix . '/validation_test', [$controller, 'validation_test']);
    $router->get($prefix . '/redirect_test', [$controller, 'redirect_test'], ['name' => 'redirect_test']);
    $router->get($prefix . '/exeption_test', [$controller, 'exeption_test']);
    $router->get($prefix . '/auth_test', [$controller, 'auth_test'], ['auth' => 'user']);
    $router->get($prefix . '/frontend_test', [$controller, 'frontend_test'], ['auth' => 'user']);
    $router->post($prefix . '/api_post', [$controller, 'api_post'], ['auth' => 'user']);
    $router->get($prefix . '/api_get', [$controller, 'api_get'], ['auth' => 'user']);
    $router->post($prefix . '/api_post_nosession', [$controller, 'api_post_nosession'], ['nosession' => true]);
    $router->get($prefix . '/design', [$controller, 'design']);
})($router);

// 別ファイルにしているルート読み込み
(function ($router) {
    include(__DIR__ . '/routes/auth.php');
})($router);

(function ($router) {
    include(__DIR__ . '/routes/admin.php');
})($router);

(function ($router) {
    include(__DIR__ . '/routes/admin_auth.php');
})($router);
