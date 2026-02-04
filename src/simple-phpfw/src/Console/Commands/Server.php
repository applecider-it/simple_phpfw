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

    /** コマンド説明の詳細 */
    public static string $descDetail = '--port=9001 でポート番号変更。デフォルトは9000。';

    /** ハンドル */
    public function handle()
    {
        $port = 9000;

        if (isset($this->options['port'])) {
            $port = $this->options['port'];
        }

        system('php -S localhost:' . $port . ' -t public');
    }
}
