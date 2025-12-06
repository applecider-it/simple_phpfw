<?php

namespace App\Services\WebSocket;

/**
 * WebSocketサーバー
 */
class WebSocketServer
{
    private $address;
    private $port;
    private $server;
    private $clients = [];

    /**
     * コンストラクタ
     * @param string $address 接続受付アドレス (0.0.0.0 = 全てのホストから)
     * @param int $port ポート番号
     */
    public function __construct(string $address = "0.0.0.0", int $port = 8080)
    {
        $this->address = $address;
        $this->port = $port;
    }

    /**
     * WebSocketサーバー起動
     */
    public function start()
    {
        // TCPソケットサーバー生成
        $this->server = stream_socket_server("tcp://{$this->address}:{$this->port}", $errno, $errstr);
        if (!$this->server) {
            die("Server creation failed: $errstr ($errno)\n");
        }

        echo "WebSocket server started on {$this->address}:{$this->port}\n";

        // 無限ループで接続と通信処理
        while (true) {
            $read = array_merge([$this->server], $this->clients);
            $timeout = 1;
            stream_select($read, $write, $except, $timeout);

            echo "stream_select" . count($read) . "\n";
            print_r($read);

            // 新規接続を検出
            if (in_array($this->server, $read)) {
                echo "new connection\n";
                $this->acceptClient();
                unset($read[array_search($this->server, $read)]);
            }

            // 既に接続中のクライアントを処理
            foreach ($read as $client) {
                echo "client\n";
                $this->readFromClient($client);
            }

            // 少しスリープして CPU 低減
            usleep(500000);
        }
    }

    /**
     * 新しいクライアントの接続を受け付ける
     */
    private function acceptClient()
    {
        $conn = stream_socket_accept($this->server);
        $this->clients[] = $conn;
    }

    /**
     * クライアントからのデータを読み取り処理する
     */
    private function readFromClient($client)
    {
        $data = fread($client, 2048);

        // データが無い＝接続終了
        if (!$data) {
            $this->disconnectClient($client);
            return;
        }

        // 初回はハンドシェイク処理
        if ($this->isHandshakeRequest($data)) {
            $this->handshake($client, $data);
            return;
        }

        // 通常のWebSocketデータフレームとしてデコード
        $msg = $this->decode($data);
        echo "Received: $msg\n";

        // 全員にブロードキャスト
        $this->broadcast($msg);
    }

    /**
     * クライアント切断処理
     */
    private function disconnectClient($client)
    {
        fclose($client);
        unset($this->clients[array_search($client, $this->clients)]);
    }

    /**
     * ハンドシェイクデータかチェック
     */
    private function isHandshakeRequest(string $data): bool
    {
        return preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $data);
    }

    /**
     * クライアントとWebSocketハンドシェイク
     */
    private function handshake($client, string $data)
    {
        preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $data, $matches);
        $key = trim($matches[1]);

        // Acceptキーの計算 (WebSocket規格)
        $accept = base64_encode(
            sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true)
        );

        $response =
            "HTTP/1.1 101 Switching Protocols\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept: $accept\r\n\r\n";

        fwrite($client, $response);
    }

    /**
     * 受信データフレームのデコード
     */
    private function decode(string $data): string
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

    /**
     * 全クライアントに送信
     */
    private function broadcast(string $msg)
    {
        $send = "\x81" . chr(strlen($msg)) . $msg; // 送信用のWebSocketフレーム形成

        foreach ($this->clients as $client) {
            @fwrite($client, $send);
        }
    }
}
