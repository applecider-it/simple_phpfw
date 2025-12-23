<?php

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use App\Services\WebSocket\Server;

$config = include(dirname(__DIR__) . '/config/config.php');

$server = new Server($config);
$server->start();
