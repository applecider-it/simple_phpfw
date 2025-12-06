<?php

namespace App\Controllers;

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
        $secret = "your-secret-key";
        $payload = [
            'user_id' => 123,
            'exp' => time() + 3600  // 有効期限（1時間）
        ];

        $token = Create::create_jwt($payload, $secret);

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('chat.index', compact('token')),
        ]);
    }
}
