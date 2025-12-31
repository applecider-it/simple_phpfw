<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Data\Arr;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Web\Location;
use SFW\Web\Flash;
use SFW\Output\Log;

use App\Models\User;
use App\Models\User\Tweet;

use App\Core\Validator;

use App\Services\WebSocket\AuthService;
use App\Services\Channels\TweetChannel;

use App\Services\Tweet\WebScoketService;

/**
 * ツイートコントローラー
 */
class TweetController extends Controller
{
    /** 一覧画面 */
    public function index()
    {
        return $this->render('tweet.index', $this->getCommonInfo());
    }

    /** 登録処理 */
    public function store()
    {
        $form = Arr::choise($this->params, ['content']);

        $commit = $this->params['commit'] ?? null;
        $confirm = $this->params['confirm'] ?? null;

        $rules = [
            'content' => Tweet::validationContent(),
        ];

        $labels = [
            'content' => Lang::get('models.user/tweet.attributes.content'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            // エラーがあるとき

            $errors = $v->errors();

            return $this->render('tweet.index', $form + ['errors' => $errors] + $this->getCommonInfo());
        } else {
            // エラーがないとき

            if (! $commit) {
                // 確定以外

                if ($confirm) {
                    // 確認へ遷移するとき

                    return $this->render('tweet.confirm', $form + $this->getCommonInfo());
                } else {
                    // フォームに戻るとき

                    return $this->render('tweet.index', $form + $this->getCommonInfo());
                }
            }
        }

        $user = App::get('user');
        $newId = Tweet::insert(['user_id' => $user['id']] + $form);
        Log::info('New Tweet', [$newId]);

        $webScoketService = new WebScoketService();
        $webScoketService->broadcastTweet($form);

        Flash::set('notice', '投稿しました。');

        Location::redirect("/tweets");
    }

    /** 共通情報 */
    private function getCommonInfo()
    {
        return $this->getRelationInfo() + $this->getWebSocketInfo();
    }

    /** 関連情報 */
    private function getRelationInfo()
    {
        $tweets = Tweet::query()
            ->order("id desc")
            ->limit(10)
            ->all();

        Tweet::withUser($tweets);

        return compact('tweets');
    }

    /** WebSocketのデータ */
    private function getWebSocketInfo()
    {
        $user = App::get('user');

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, TweetChannel::getChannel());

        return compact('token');
    }
}
