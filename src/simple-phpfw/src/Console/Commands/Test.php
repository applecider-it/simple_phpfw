<?php

declare(strict_types=1);

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

    /** コマンド説明の詳細 */
    public static string $descDetail = '--fw をつけると、フレームワークのテスト。';

    /** ハンドル */
    public function handle()
    {
        $starter = new Starter();

        $starter->exec($this->options['fw'] ?? false);
    }
}
