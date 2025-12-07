<?php

namespace App\Services\WebSocket;

use App\Services\WebSocketCore\WebSocketServer;
use App\Services\WebSocketCore\Broadcast;
use App\Services\JWT\Parce;

/**
 * WebSocketサーバー
 */
class Server
{
    /** 環境変数 */
    private array $env;

    /** クライアント情報配列 */
    private array $clientInfos = [];

    public function __construct($env)
    {
        $this->env = $env;
    }

    public function start()
    {
        $ws = new WebSocketServer("0.0.0.0", 8080);

        $ws->onConnected = function (WebSocketServer $wss, $clientSocket, $requestParams) {
            $this->onConnected($wss, $clientSocket, $requestParams);
        };

        $ws->onClose = function (WebSocketServer $wss, $clientSocket) {
            $this->onClose($wss, $clientSocket);
        };

        $ws->onMessage = function (WebSocketServer $wss, $senderSocket, $msg) {
            $this->onMessage($wss, $senderSocket, $msg);
        };

        $ws->start();
    }

    /**
     * 接続時。
     * 
     * 正確には、ハンドシェイク時。
     */
    private function onConnected(WebSocketServer $wss, $clientSocket, $requestParams)
    {
        echo "onConnected: " . (int)$clientSocket . " " . json_encode($requestParams) . "\n";

        $token = $requestParams['token'];

        $secret = $this->env['SFW_JWT_SECRET'];
        $result = Parce::verify_jwt($token, $secret);
        if ($result) {
            echo "Valid token\n";
            print_r($result);
        } else {
            echo "Invalid token\n";
            $wss->disconnectClient($clientSocket);
            return;
        }

        $this->clientInfos[(int)$clientSocket] = [
            'socket' => $clientSocket,
            'user' => $result,
        ];

        echo "client cnt: " . count($this->clientInfos) . "\n";
    }

    /**
     * クローズ時。
     */
    private function onClose(WebSocketServer $wss, $clientSocket)
    {
        echo "onClose: " . (int)$clientSocket . "\n";

        unset($this->clientInfos[(int)$clientSocket]);

        echo "client cnt: " . count($this->clientInfos) . "\n";
    }

    /**
     * メッセージ受信時
     */
    private function onMessage(WebSocketServer $wss, $senderSocket, $msg)
    {
        echo "onMessage: " . (int)$senderSocket . " {$msg}\n";

        $this->broadcast($msg);
    }

    /**
     * 全クライアントに送信
     */
    private function broadcast(string $msg)
    {
        foreach ($this->clientInfos as $socketNumber => $clientInfo) {
            $client = $clientInfo['socket'];
            Broadcast::send($client, $msg);
        }
    }
}
