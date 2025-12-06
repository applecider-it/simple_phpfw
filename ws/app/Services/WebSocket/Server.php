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
    /** クライアント情報配列 */
    private $clientInfos = [];

    public function start()
    {
        $ws = new WebSocketServer("0.0.0.0", 8080);

        $ws->onConnected = function ($wss, $clientSocket, $params) {
            echo "onConnected: " . (int)$clientSocket . " " . json_encode($params) . "\n";

            $token = $params['token'];

            $secret = 'your-secret-key';
            $result = Parce::verify_jwt($token, $secret);
            if ($result) {
                print_r($result);
            } else {
                echo "Invalid token\n";
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
