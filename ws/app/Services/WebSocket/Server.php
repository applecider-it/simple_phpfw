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

        $ws->onConnected = function (WebSocketServer $wss, $clientSocket, $params) {
            echo "onConnected: " . (int)$clientSocket . " " . json_encode($params) . "\n";

            $token = $params['token'];

            $secret = $this->env['SFW_JWT_SECRET'];
            $result = Parce::verify_jwt($token, $secret);
            if ($result) {
                print_r($result);
            } else {
                echo "Invalid token\n";
                $wss->disconnectClient($clientSocket);
                return;
            }

            $this->clientInfos[(int)$clientSocket] = [
                'socket' => $clientSocket,
                'params' => $params,
            ];

            echo "client cnt: " . count($this->clientInfos) . "\n";
        };
        $ws->onClose = function ($wss, $clientSocket) {
            echo "onClose: " . (int)$clientSocket . "\n";

            unset($this->clientInfos[(int)$clientSocket]);

            echo "client cnt: " . count($this->clientInfos) . "\n";
        };
        $ws->onMessage = function ($wss, $senderSocket, $msg) {
            echo "onMessage: " . (int)$senderSocket . " {$msg}\n";

            $this->broadcast($msg);
        };

        $ws->start();
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
