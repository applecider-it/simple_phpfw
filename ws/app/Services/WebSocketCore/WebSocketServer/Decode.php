<?php

namespace App\Services\WebSocketCore\WebSocketServer;

/**
 * WebSocketサーバーのデコード処理
 */
class Decode
{
    /**
     * 受信データフレームのデコード
     */
    public static function decode(string $data): string
    {
        $len = ord($data[1]) & 127;
        $mask = substr($data, 2, 4); // マスクキー
        $msg = '';

        // マスク解除
        for ($i = 0; $i < $len; $i++) {
            $msg .= $data[$i + 6] ^ $mask[$i % 4];
        }

        return $msg;
    }
}
