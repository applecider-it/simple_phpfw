<?php

require dirname(__DIR__) . '/app/Services/Development/BenchmarkService.php';
$benchmarkService = new App\Services\Development\BenchmarkService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** 起動タイプ（SFWで必要な定数） */
define('SFW_BOOT_TYPE', 'web');

require_once dirname(__DIR__) . '/bootstrap/app.php';

(new SFW\Boot\Web)->dispatch();

$benchmarkService->closeBenchmark();
