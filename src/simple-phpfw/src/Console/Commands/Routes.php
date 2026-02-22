<?php

declare(strict_types=1);

namespace SFW\Console\Commands;

use SFW\Console\Command;

use SFW\Web\Trace;

/**
 * ルート一覧
 */
class Routes extends Command
{
    /** コマンド名 */
    public static string $name = 'routes';

    /** コマンド説明 */
    public static string $desc = 'ルート一覧';

    /** コマンド説明の詳細 */
    public static string $descDetail = '--op をつけると、optionsも含めて表示。';

    /** ハンドル */
    public function handle()
    {
        Trace::outputRoutes($this->options['op'] ?? false);
    }
}
