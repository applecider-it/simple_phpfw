<?php

namespace SFW\Boot;

use SFW\Console\Starter;

/**
 * Consoleのブート時の処理
 */
class Console
{
    /** 実行 */
    public function dispatch($argv): void
    {
        $starter = new Starter();

        $starter->dispatch($argv);
    }
}
