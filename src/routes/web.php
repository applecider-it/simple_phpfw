<?php

/**
 * ルート設定
 * 
 * クロージャーで囲うことで、ローカル変数を保護している。
 */

use App\Controllers\HomeController;
use App\Controllers\TweetController;
use App\Controllers\ChatController;
use App\Controllers\DevelopmentController;

// トップページ
$router->get('/', [HomeController::class, 'index']);

// チャット
$router->get('/chat', [ChatController::class, 'index'], ['auth' => 'user']);

// ツイート
(function ($router) {
    $options = ['auth' => 'user'];

    $prefix = '/tweets';
    $controller = TweetController::class;

    $router->get($prefix, [$controller, 'index'], $options);
    $router->post($prefix, [$controller, 'store'], $options);
})($router);

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
    $router->get($prefix . '/javascript_test', [$controller, 'javascript_test'], ['auth' => 'user']);
    $router->post($prefix . '/api_post', [$controller, 'api_post'], ['auth' => 'user']);
    $router->get($prefix . '/api_get', [$controller, 'api_get'], ['auth' => 'user']);
    $router->post($prefix . '/api_post_nosession', [$controller, 'api_post_nosession'], ['nosession' => true]);
    $router->get($prefix . '/design', [$controller, 'design']);
    $router->get($prefix . '/php_test', [$controller, 'php_test']);
})($router);

// 別ファイルにしているルート読み込み
(function ($router) {
    include(__DIR__ . '/_auth.php');
})($router);

(function ($router) {
    include(__DIR__ . '/_admin.php');
})($router);

(function ($router) {
    include(__DIR__ . '/_admin_auth.php');
})($router);
