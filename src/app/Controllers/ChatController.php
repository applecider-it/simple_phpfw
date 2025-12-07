<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\View;
use SFW\JWT\Create;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $user = App::get('user');
        $secret = Config::get('jwt_secret');

        $payload = [
            'channel' => 'chat:',
            'id' => $user['id'],
            'name' => $user['name'],
            'exp' => time() + 3600  // 有効期限（1時間）
        ];

        $token = Create::createJwt($payload, $secret);

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('chat.index', compact('token')),
        ]);
    }
}
