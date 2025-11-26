<?php

namespace SFW\Console\Commands;

use SFW\Console\Command;

use SFW\Test\Starter;

/**
 * ユニットテスト
 */
class Test extends Command
{
    /** コマンド名 */
    public static string $name = 'test';

    /** コマンド説明 */
    public static string $desc = 'ユニットテスト';

    /** ハンドル */
    public function handle()
    {
        $starter = new Starter();

        $starter->exec($this->options['framework'] ?? false);
    }
}
