<?php

use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/test/{id}', [HomeController::class, 'test']);

