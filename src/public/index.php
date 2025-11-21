<?php

// 開始時
$startTime = microtime(true);
$startMemory = memory_get_usage();

require dirname(__DIR__) . '/boot/start.php';

(new SFW\Boot\Common)->init();
(new SFW\Boot\Web)->dispatch();

// 終了時
$endTime = microtime(true);
$endMemory = memory_get_usage();

$executionTime = $endTime - $startTime;
$memoryUsed = ($endMemory - $startMemory) / 1024 / 1024; // MB単位

$trace = [
    '処理時間（秒）' => $executionTime,
    'メモリ使用量（MB）' => $memoryUsed,
    'メモリ使用量（MB）開始時' => $startMemory / 1024 / 1024,
    'メモリ使用量（MB）終了時' => $endMemory / 1024 / 1024,
    'opcache_get_status()' => opcache_get_status(),
];
echo "<div>--------------- performance trace begin ---------------</div>\n";
echo "<div>performance:</div>\n";
echo "<pre>\n";
echo SFW\Output\Html::esc(print_r($trace, true));
echo "</pre>\n";
echo "<div>--------------- performance trace end ---------------</div>\n";