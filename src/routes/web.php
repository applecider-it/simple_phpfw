<?php

/**
 * ルート設定
 * 
 * クロージャーで囲うことで、ローカル変数を保護している。
 */

use App\Controllers\HomeController;
use App\Controllers\TweetController;
use App\Controllers\TweetJsController;
use App\Controllers\ChatController;
use App\Controllers\DevelopmentController;

// トップページ
$router->get('/', [HomeController::class, 'index'], ['name' => 'index']);

// チャット
$router->get('/chat', [ChatController::class, 'index'], ['auth' => 'user', 'name' => 'chat.index']);
$router->post('/chat/store_redis', [ChatController::class, 'store_redis'], ['auth' => 'user']);

// ツイート
(function ($router) {
    $options = ['auth' => 'user'];

    $prefix = '/tweets';
    $controller = TweetController::class;

    $router->get($prefix, [$controller, 'index'], $options + ['name' => 'tweets.index']);
    $router->post($prefix, [$controller, 'store'], $options + ['name' => 'tweets.store']);
})($router);

// ツイートJS
(function ($router) {
    $options = ['auth' => 'user'];

    $prefix = '/tweets_js';
    $controller = TweetJsController::class;

    $router->get($prefix, [$controller, 'index'], $options + ['name' => 'tweets_js.index']);
    $router->get($prefix . '/list', [$controller, 'list'], $options);
    $router->post($prefix . '/store', [$controller, 'store'], $options);
})($router);

// 開発者向けページ
(function ($router) {
    $prefix = '/development';
    $controller = DevelopmentController::class;

    $router->get($prefix, [$controller, 'index'], ['name' => 'development.index']);
    $router->get($prefix . '/view_test', [$controller, 'view_test'], ['name' => 'development.view_test']);
    $router->post($prefix . '/view_test_post', [$controller, 'view_test_post'], ['name' => 'development.view_test_post']);
    $router->get($prefix . '/render_test', [$controller, 'render_test'], ['name' => 'development.render_test']);
    $router->get($prefix . '/template_test', [$controller, 'template_test'], ['name' => 'development.template_test']);
    $router->get($prefix . '/param_test/{id}', [$controller, 'param_test'], ['name' => 'development.param_test']);
    $router->post($prefix . '/param_test/{id}', [$controller, 'param_test']);
    $router->get($prefix . '/database_test', [$controller, 'database_test'], ['name' => 'development.database_test']);
    $router->get($prefix . '/validation_test', [$controller, 'validation_test'], ['name' => 'development.validation_test']);
    $router->get($prefix . '/redirect_test', [$controller, 'redirect_test'], ['name' => 'development.redirect_test']);
    $router->get($prefix . '/exeption_test', [$controller, 'exeption_test'], ['name' => 'development.exeption_test']);
    $router->get($prefix . '/view_exception_test', [$controller, 'view_exception_test'], ['name' => 'development.view_exception_test']);
    $router->get($prefix . '/javascript_test', [$controller, 'javascript_test'], ['auth' => 'user', 'name' => 'development.javascript_test']);
    $router->post($prefix . '/api_post', [$controller, 'api_post'], ['auth' => 'user']);
    $router->get($prefix . '/api_get', [$controller, 'api_get'], ['auth' => 'user']);
    $router->post($prefix . '/api_post_nosession', [$controller, 'api_post_nosession'], ['nosession' => true]);
    $router->get($prefix . '/design', [$controller, 'design'], ['name' => 'development.design']);
    $router->get($prefix . '/php_test', [$controller, 'php_test'], ['name' => 'development.php_test']);
    $router->get($prefix . '/html_test', [$controller, 'html_test'], ['name' => 'development.html_test']);
})($router);

// 別ファイルにしているルート読み込み
(function ($router) {
    include(__DIR__ . '/web/auth.php');
})($router);

(function ($router) {
    include(__DIR__ . '/web/admin.php');
})($router);

(function ($router) {
    include(__DIR__ . '/web/admin_auth.php');
})($router);
