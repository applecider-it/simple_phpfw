<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Services\WebSocket\Server;

$server = new Server();
$server->start();
