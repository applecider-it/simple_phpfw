<?php

namespace App\Commands;

use App\Services\Commands\SampleCommandService;

/**
 * サンプルのコマンド
 */
class SampleCommand extends Command
{
    /** コマンド名 */
    public static string $name = 'app-samplecommand';

    /** コマンド説明 */
    public static string $desc = 'サンプルコマンド';

    /** ハンドル */
    public function handle()
    {
        $sampleCommandService = new SampleCommandService;

        $sampleCommandService->exec($this->params, $this->options);
    }
}
