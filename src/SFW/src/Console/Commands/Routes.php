<?php

namespace SFW\Console\Commands;

use SFW\Console\Command;

use SFW\Routing\Trace;

/**
 * ルート一覧
 */
class Routes extends Command
{
    /** コマンド名 */
    public static string $name = 'routes';

    /** コマンド説明 */
    public static string $desc = 'ルート一覧';

    /** ハンドル */
    public function handle()
    {
        Trace::outputRoutes();
    }
}
