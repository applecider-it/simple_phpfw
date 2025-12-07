<?php

namespace App\Commands;

use App\Services\Commands\WebSocketTestCommandService;

/**
 * WebSocketの動作確認コマンド
 */
class WebSocketTest extends Command
{
    /** コマンド名 */
    public static string $name = 'app-web-socket-test';

    /** コマンド説明 */
    public static string $desc = 'WebSocketの動作確認';

    /** ハンドル */
    public function handle()
    {
        $webSocketTestCommandService = new WebSocketTestCommandService;

        $webSocketTestCommandService->exec($this->params, $this->options);
    }
}
