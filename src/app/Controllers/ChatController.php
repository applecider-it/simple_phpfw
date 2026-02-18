<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\ChatChannel;
use App\Services\Chat\RoomService;
use App\Services\User\AuthService as Auth;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $authService = new AuthService;
        $roomService = new RoomService;

        $user = Auth::get();

        $room = $this->params['room'] ?? null;

        $ret = $roomService->getRoomInfo($room);

        $room = $ret['room'];
        $rooms = $ret['rooms'];

        $token = $authService->createUserJwt($user, ChatChannel::getChannel($room));

        return $this->render('chat.index', compact('token', 'rooms', 'room'));
    }
}
