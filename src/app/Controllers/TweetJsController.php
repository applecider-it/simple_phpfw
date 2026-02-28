<?php

namespace App\Controllers;

use SFW\Core\App;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\TweetChannel;
use App\Services\User\AuthService as Auth;
use App\Models\User\Tweet;

/**
 * ツイート(JS)コントローラー
 */
class TweetJsController extends Controller
{
    /** 画面 */
    public function index()
    {
        $user = Auth::get();

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, TweetChannel::getChannel());

        return $this->render('tweet_js.index', compact('token'));
    }

    /** 一覧取得 */
    public function list()
    {
        $user = Auth::get();

        $tweets = Tweet::query()
            ->order("id desc")
            ->limit(10)
            ->all();

        Tweet::withUser($tweets);

        return compact('tweets');
    }
}
