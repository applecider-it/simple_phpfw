<?php

namespace App\Services\WebSocketCore\WebSocketServer;

/**
 * WebSocketサーバーのハンドシェイク処理
 */
class Handshake
{
    /**
     * ハンドシェイクデータかチェック
     */
    public static function isHandshakeRequest(string $data): bool
    {
        return preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $data);
    }

    public static function handshake($client, string $data)
    {
        // GETリクエスト行からパス部分を抽出
        preg_match('#GET (.*) HTTP/1\.1#', $data, $matches);
        $path = $matches[1] ?? "/";  // 例: "/?user=abc&room=1"

        // クエリパラメーター解析
        $params = [];
        if (strpos($path, '?') !== false) {
            parse_str(parse_url($path, PHP_URL_QUERY), $params);
        }

        // WebSocket Accept計算
        preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $data, $k);
        $key = trim($k[1]);
        $accept = base64_encode(
            sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true)
        );

        $response =
            "HTTP/1.1 101 Switching Protocols\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept: $accept\r\n\r\n";

        fwrite($client, $response);

        // 確認用ログ
        echo "Client connected params: " . json_encode($params, JSON_UNESCAPED_UNICODE) . PHP_EOL;

        return $params;
    }
}
