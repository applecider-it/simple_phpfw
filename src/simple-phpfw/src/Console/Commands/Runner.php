<?php

namespace SFW\Console\Commands;

use SFW\Console\Command;

/**
 * コード実行
 */
class Runner extends Command
{
    /** コマンド名 */
    public static string $name = 'runner';

    /** コマンド説明 */
    public static string $desc = 'コード実行';

    /** ハンドル */
    public function handle()
    {
        $code = $this->params[0] ?? '';

        echo "code: {$code}" . PHP_EOL;
        echo PHP_EOL;

        eval($code);

        echo str_repeat(PHP_EOL, 2);
    }
}
