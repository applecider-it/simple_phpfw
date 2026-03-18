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
    public static string $desc = 'Viewのテンポラリーファイル削除';

    /** ハンドル */
    public function handle()
    {
        $cmd = "rm " . SFW_PROJECT_ROOT . "/storage/views/*.php";

        echo "cmd: {$cmd}" . PHP_EOL;
        echo PHP_EOL;

        system($cmd);
    }
}
