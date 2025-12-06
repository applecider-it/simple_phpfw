<?php

namespace App\Services\WebSocketCore;

/**
 * WebSocketサーバー
 */
class WebSocketServer
{
    private $address;
    private $port;

    /** サーバーresource */
    private $server;

    /** クライアントresource配列 */
    private $clients = [];

    /** 接続時のコールバック */
    public \Closure $onConnected;

    /** 切断時のコールバック */
    public \Closure $onClose;

    /** メッセージ受信時のコールバック */
    public \Closure $onMessage;

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

            //echo "stream_select: read count: " . count($read) . "\n";
            //print_r($read);

            // 新規接続を検出
            if (in_array($this->server, $read)) {
                echo "new connection\n";
                $this->acceptClient();
                unset($read[array_search($this->server, $read)]);
                echo "after new connection read count: " . count($read) . "\n";
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

        $op = ord($data[0]) & 0x0F;

        if ($op === 0x8) {
            // Close frame
            echo "Close frame\n";
            $this->disconnectClient($client);
            return;
        }

        if ($op === 0x9) {
            // Ping frame
            // → Pong を返す
            echo "Ping frame\n";
            fwrite($client, "\x8A\x00");
            return;
        }

        if ($op === 0xA) {
            // Pong frame
            echo "Pong frame\n";
            return;
        }

        // 初回はハンドシェイク処理
        if (WebSocketServer\Handshake::isHandshakeRequest($data)) {
            echo "Handshake: " . (int)$client . "\n";
            $params = WebSocketServer\Handshake::handshake($client, $data);

            ($this->onConnected)($this, $client, $params);
            return;
        }

        // 通常のWebSocketデータフレームとしてデコード
        $msg = WebSocketServer\Decode::decode($data);
        echo "Received: $msg\n";

        // 全員にブロードキャスト
        ($this->onMessage)($this, $client, $msg);
    }

    /**
     * クライアント切断処理
     */
    public function disconnectClient($client)
    {
        echo "Disconnect: " . (int)$client . "\n";
        fclose($client);
        unset($this->clients[array_search($client, $this->clients)]);
        ($this->onClose)($this, $client);
    }
}
