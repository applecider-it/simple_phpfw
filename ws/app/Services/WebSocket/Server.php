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

    /** Redis */
    private $redis;

    public function __construct($env)
    {
        $this->env = $env;
    }

    public function start()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1', 6379);

        $ws = new WebSocketServer("0.0.0.0", 9090);

        $ws->onConnected = function (WebSocketServer $wss, $clientSocket, $requestParams) {
            $this->onConnected($wss, $clientSocket, $requestParams);
        };

        $ws->onClose = function (WebSocketServer $wss, $clientSocket) {
            $this->onClose($wss, $clientSocket);
        };

        $ws->onMessage = function (WebSocketServer $wss, $senderSocket, $msg) {
            $this->onMessage($wss, $senderSocket, $msg);
        };

        $ws->onLoop = function (WebSocketServer $wss) {
            $this->onLoop($wss);
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

        $sender = $this->clientInfos[(int)$senderSocket]['user'];

        $data = json_decode($msg, true);

        $this->sendCommon($data, $sender);
    }

    /**
     * ループ時
     */
    private function onLoop(WebSocketServer $wss)
    {
        //echo "onLoop: \n";

        $this->redisProcess($wss);
    }

    /**
     * Redis連携
     */
    private function redisProcess(WebSocketServer $wss)
    {
        foreach (range(1, 100) as $number) {
            $item = $this->redis->lPop('websocket_publish');
            if (! $item) return;

            $data = json_decode($item, true);

            echo "redis:\n";
            print_r($data);

            $sendData = [
                'data' => $data['data'],
            ];
            $sender = [
                'id' => 0,
                'name' => 'System',
                'channel' => $data['channel'],
            ];

            $this->sendCommon($sendData, $sender);
        }
    }

    /**
     * WebSocket、Redis共通の送信処理
     */
    private function sendCommon(array $data, array $sender)
    {
        echo "sender: " . print_r($sender, true);

        foreach ($this->clientInfos as $socketNumber => $clientInfo) {
            $clientSocket = $clientInfo['socket'];
            $clientUser = $clientInfo['user'];

            echo "clientUser: " . print_r($clientUser, true);

            if ($sender['channel'] !== $clientUser['channel']) continue;

            $sendStr = json_encode([
                'data' => $data['data'],
                'sender' => [
                    'id' => $sender['id'],
                    'name' => $sender['name'],
                ]
            ]);

            Broadcast::send($clientSocket, $sendStr);

            echo "sended\n";
        }
    }
}
