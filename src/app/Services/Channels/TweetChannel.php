<?php

namespace App\Services\Channels;

/**
 * ツイートチャンネル
 */
class TweetChannel{
    private const CHANNEL_ID = 'tweet';

    /** チャンネル名を返す */
    public static function getChannel() {
        return self::CHANNEL_ID . ':';
    }
}