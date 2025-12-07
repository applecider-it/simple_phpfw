<?php

namespace App\Services\WebSocketCore;

/**
 * WebSocketサーバー
 * 
 * NodeのWebSocketサーバーみたいに使えるけど、同期処理なので注意。
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
            $this->roopProcess();

            // 少しスリープして CPU 低減
            usleep(500000);
        }
    }

    /**
     * 無限ループで接続と通信処理
     */
    private function roopProcess()
    {
        // すべてのソケットをまとめる
        $read = array_merge([$this->server], $this->clients);

        // 受信するまで$timeout秒待機
        // 接続リクエストとメッセージリクエストがまざって$readに返ってくる
        $timeout = 1;
        stream_select($read, $write, $except, $timeout);

        //echo "stream_select: read count: " . count($read) . "\n";
        //print_r($read);

        if (in_array($this->server, $read)) {
            // 新規接続を検出したとき

            $this->acceptClient();

            // $readから接続情報を除外
            unset($read[array_search($this->server, $read)]);
            //echo "after new connection read count: " . count($read) . "\n";
        }

        // クライアントからのメッセージ送信の処理
        foreach ($read as $client) {
            echo "client: " . (int)$client . "\n";

            $this->readFromClient($client);
        }
    }

    /**
     * 新しいクライアントの接続を受け付ける
     */
    private function acceptClient()
    {
        $conn = stream_socket_accept($this->server);

        echo "new client" . (int)$conn . "\n";
        
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
            // クローズフレームの時

            echo "Close frame\n";
            $this->disconnectClient($client);
            return;
        }

        if ($op === 0x9) {
            // Pingフレームの時

            // → Pong を返す
            echo "Ping frame\n";
            fwrite($client, "\x8A\x00");
            return;
        }

        if ($op === 0xA) {
            // Pongフレームの時
            
            echo "Pong frame\n";
            return;
        }

        if (WebSocketServer\Handshake::isHandshakeRequest($data)) {
            // ハンドシェイク処理の時
            // accept直後に、初回だけ来る

            echo "Handshake: " . (int)$client . "\n";
            $params = WebSocketServer\Handshake::handshake($client, $data);

            ($this->onConnected)($this, $client, $params);
            return;
        }

        $msg = WebSocketServer\Decode::decode($data);

        echo "Received: $msg\n";

        // コールバックに返す
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
