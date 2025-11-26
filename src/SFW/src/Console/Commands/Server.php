<?php

namespace SFW\Console\Commands;

use SFW\Console\Command;

/**
 * サーバー起動
 */
class Server extends Command
{
    /** コマンド名 */
    public static string $name = 'server';

    /** コマンド説明 */
    public static string $desc = 'サーバー起動';

    /** ハンドル */
    public function handle()
    {
        system('php -S localhost:8000 -t public');
    }
}
