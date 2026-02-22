<?php

declare(strict_types=1);

namespace SFW\Console\Commands;

use SFW\Console\Command;
use SFW\Generator\Starter;

/**
 * ジェネレーター
 */
class Generator extends Command
{
    /** コマンド名 */
    public static string $name = 'generator';

    /** コマンド説明 */
    public static string $desc = 'ジェネレーター';

    /** コマンド説明の詳細 */
    public static string $descDetail = 'パラメーター
name [第2引数以降はジェネレーターごとにちがう]

--dryrun をつけるとドライラン。
';

    /** ハンドル */
    public function handle()
    {
        $starter = new Starter;

        $starter->exec($this->params, $this->options);
    }
}
