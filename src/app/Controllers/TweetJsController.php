<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Data\Arr;
use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Response;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\TweetChannel;
use App\Services\User\AuthService as Auth;
use App\Services\Tweet\WebScoketService;
use App\Services\Tweet\ListService;

use App\Models\User\Tweet;

use App\Validations\Validator;

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

    /** 一覧取得API */
    public function list()
    {
        $listService = new ListService;

        return $listService->getTweets();
    }

    /** 登録処理API */
    public function store()
    {
        $form = Arr::choise($this->params, ['content']);

        //usleep(1000000 * 5);

        $rules = [
            'content' => Tweet::validationContent(),
        ];

        $labels = [
            'content' => Lang::get('app.models.user/tweet.attributes.content'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            // エラーがあるとき

            $errors = $v->errors();

            Response::code(Response::CODE_UNPROCESSABLE_ENTITY);
            return compact('errors');
        }

        $user = Auth::get();

        $newId = Tweet::insert(['user_id' => $user['id']] + $form);
        Log::info('New Tweet', [$newId]);

        $webScoketService = new WebScoketService();
        $webScoketService->broadcastTweet($form);

        return compact('newId');
    }
}
