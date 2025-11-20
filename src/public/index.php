<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';

use SFW\Router;

use App\Controllers\HomeController;

$router = new Router();

// ルーティング定義
$router->get('/', [HomeController::class, 'index']);
$router->post('/test', [HomeController::class, 'test']);


// ルーター実行
$router->dispatch();