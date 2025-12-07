<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Services\WebSocket\Server;
use App\Services\Core\Env;

$env = Env::load(dirname(__DIR__) . '/.env');

$server = new Server($env);
$server->start();
