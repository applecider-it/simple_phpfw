<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\View;

use App\Services\WebSocket\AuthService;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $user = App::get('user');

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, 'chat:');

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('chat.index', compact('token')),
        ]);
    }
}
