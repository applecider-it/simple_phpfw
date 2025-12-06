<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Services\WebSocket\WebSocketServer;

$ws = new WebSocketServer("0.0.0.0", 8080);
$ws->start();
