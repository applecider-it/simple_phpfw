<?php

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use App\Services\WebSocket\Setup;

/**
 * WSサーバーエントリーポイント
 */

Setup::exec();
