<?php

declare(strict_types=1);

namespace SFW\Console\Commands;

use SFW\Console\Command;

/**
 * 各種クリア
 */
class Clear extends Command
{
    /** コマンド名 */
    public static string $name = 'clear';

    /** コマンド説明 */
    public static string $desc = '各種クリア';

    /** ハンドル */
    public function handle()
    {
        $cmd = "rm " . SFW_PROJECT_ROOT . "/storage/logs/*.log";

        echo "cmd: {$cmd}" . PHP_EOL;
        echo PHP_EOL;

        system($cmd);
    }
}
