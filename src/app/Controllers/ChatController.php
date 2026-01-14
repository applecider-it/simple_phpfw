<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;

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
            'default',
            'room1',
            'room2',
            'room3',
        ];

        $room = $this->params['room'] ?? null;
        if (! in_array($room, $rooms)) $room = 'default';

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, ChatChannel::getChannel($room));

        return $this->render('chat.index', compact('token', 'rooms', 'room'));
    }
}
