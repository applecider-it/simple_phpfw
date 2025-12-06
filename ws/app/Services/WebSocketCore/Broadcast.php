<?php

namespace App\Services\WebSocketCore;

/**
 * ブロードキャスト関連
 */
class Broadcast
{
    /**
     * 送信
     */
    public static function send($socket, $msg)
    {
        $send = "\x81" . chr(strlen($msg)) . $msg; // 送信用のWebSocketフレーム形成
        @fwrite($socket, $send);
    }
}
