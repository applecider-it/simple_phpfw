<?php

namespace SFW\Boot;

use SFW\Console\Starter;

/**
 * Consoleのブート時の処理
 */
class Console
{
    public function dispatch($argv)
    {
        set_time_limit(0);

        $starter = new Starter();

        $starter->dispatch($argv);
    }
}
