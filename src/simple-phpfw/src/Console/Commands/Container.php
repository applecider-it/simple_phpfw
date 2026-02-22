<?php

declare(strict_types=1);

namespace SFW\Console\Commands;

use SFW\Console\Command;

use SFW\Core\Trace;

/**
 * コンテナのデータ一覧
 */
class Container extends Command
{
    /** コマンド名 */
    public static string $name = 'container';

    /** コマンド説明 */
    public static string $desc = 'コンテナのデータ一覧';

    /** ハンドル */
    public function handle()
    {
        Trace::traceContainer();
    }
}
