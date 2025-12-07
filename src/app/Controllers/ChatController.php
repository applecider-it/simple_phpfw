<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\View;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\ChatChannel;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $user = App::get('user');

        $rooms = [
            null,
            'room1',
            'room2',
        ];

        $room = $this->params['room'] ?? null;

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, ChatChannel::getChannel($room));

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('chat.index', compact('token', 'rooms', 'room')),
        ]);
    }
}
