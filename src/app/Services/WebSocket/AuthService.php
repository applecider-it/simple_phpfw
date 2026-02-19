<?php

namespace App\Services\WebSocket;

use SFW\JWT\Create;
use SFW\Core\Config;

/**
 * WebSocketの認証管理
 */
class AuthService
{
    /**
     * ユーザー用のWebSocket用のJWT生成
     */
    public function createUserJwt(array $user, string $channel)
    {
        $secret = Config::get('app.jwt_secret');
        $payload = [
            'channel' => $channel,
            'id' => $user['id'],
            'name' => $user['name'],
            'iat' => time(),
            'exp' => time() + 3600  // 有効期限（1時間）
        ];

        $token = Create::createJwt($payload, $secret);

        return $token;
    }
}
