<?php

declare(strict_types=1);

namespace SFW\Boot;

use SFW\Console\Starter;

/**
 * Consoleのブート時の処理
 */
class Console
{
    /** 実行 */
    public function dispatch(array $argv): void
    {
        new Common()->init();

        $starter = new Starter();

        $starter->dispatch($argv);
    }
}
