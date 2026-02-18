<?php

namespace App\Controllers;

use SFW\Core\App;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\TweetChannel;
use App\Services\User\AuthService as Auth;

/**
 * ツイート(JS)コントローラー
 */
class TweetJsController extends Controller
{
    /** 一覧画面 */
    public function index()
    {
        $user = Auth::get();

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, TweetChannel::getChannel());

        return $this->render('tweet_js.index', compact('token'));
    }
}
