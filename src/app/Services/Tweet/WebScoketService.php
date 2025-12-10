<?php

namespace App\Services\Tweet;

use SFW\Core\Config;

use App\Services\WebSocket\SystemService;
use App\Services\Channels\TweetChannel;

/**
 * ツイートのWebScoket管理
 */
class WebScoketService
{
    /**
     * ツイートをブロードキャスト
     */
    public function broadcastTweet(array $tweet)
    {
        $systemService = new SystemService;
        $systemService->publish(TweetChannel::getChannel(), [
            'content' => $tweet['content'],
        ]);
    }
}
