<?php

namespace SFW\Boot;

use SFW\Console\Starter;

/**
 * Consoleのブート時の処理
 */
class Console
{
    /** 実行 */
    public function dispatch($argv)
    {
        // タイムアウトを止める
        set_time_limit(0);

        $starter = new Starter();

        $starter->dispatch($argv);
    }
}
