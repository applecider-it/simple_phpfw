<?php

namespace App\Services\Chat;

/**
 * チャットのRoom管理
 */
class RoomService
{
    /** チャットRoom情報 */
    public function getRoomInfo(?string $room)
    {
        $rooms = [
            'default' => 'デフォルト',
            'room1' => 'ルーム１',
            'room2' => 'ルーム２',
        ];

        if (!array_key_exists($room, $rooms)) $room = 'default';

        return [
            'room' => $room,
            'rooms' => $rooms,
        ];
    }
}
