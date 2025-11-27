<?php

namespace App\Commands;

/**
 * サンプルのコマンド2
 */
class SampleCommand2 extends Command
{
    /** コマンド名 */
    public static string $name = 'app-samplecommand2';

    /** コマンド説明 */
    public static string $desc = 'サンプルコマンド2';

    /** ハンドル */
    public function handle()
    {
    }
}
