<?php

namespace App\Commands;

use App\Services\Commands\GeneratorService;

/**
 * ジェネレーター
 */
class Generator extends Command
{
    /** コマンド名 */
    public static string $name = 'app-generator';

    /** コマンド説明 */
    public static string $desc = 'ジェネレーター';

    /** コマンド説明の詳細 */
    public static string $descDetail = '--dryrun をつけるとドライラン。';

    /** ハンドル */
    public function handle()
    {
        $generatorService = new GeneratorService;

        $generatorService->exec($this->params, $this->options);
    }
}
