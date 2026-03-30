<?php

namespace App\Services\Tweet;

use App\Models\User\Tweet;

/**
 * ツイートのリスト関連
 */
class ListService
{
    /**
     * ツイート一覧
     */
    public function getTweets()
    {
        $tweets = Tweet::query()
            ->order("id desc")
            ->limit(10)
            ->all();

        Tweet::withUser($tweets);

        return compact('tweets');
    }
}
