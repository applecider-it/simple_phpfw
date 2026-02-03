<?php

// 開始時
$startTime = microtime(true);
$startMemory = memory_get_usage();

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** 起動タイプ（SFWで必要な定数） */
define('SFW_BOOT_TYPE', 'web');

require_once dirname(__DIR__) . '/boot/start.php';

(new SFW\Boot\Web)->dispatch();

// 終了時
$endTime = microtime(true);
$endMemory = memory_get_usage();

$executionTime = $endTime - $startTime;
$memoryUsed = ($endMemory - $startMemory) / 1024 / 1024; // MB単位

$opcacheStatus = opcache_get_status();

$trace = [
    '処理時間（秒）' => $executionTime,
    'メモリ使用量（MB）' => $memoryUsed,
    'メモリ使用量（MB）開始時' => $startMemory / 1024 / 1024,
    'メモリ使用量（MB）終了時' => $endMemory / 1024 / 1024,
    'opcache使用量（MB）' => $opcacheStatus['memory_usage']['used_memory'] / 1024 / 1024,
    'opcache_get_status()' => $opcacheStatus,
];


$out = '
    <div style="font-size: 0.7rem;">
        <div>--------------- performance trace begin ---------------</div>
            <div>performance:</div>
            <pre>' . SFW\Output\Html::esc(SFW\Data\Json::trace($trace, true)) . '</pre>
        <div>--------------- performance trace end ---------------</div>
    </div>
';

//echo $out;
