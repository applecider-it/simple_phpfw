<?php

namespace App\Controllers;

use SFW\Output\View;
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
        $user = App::get('user');

        $authService = new AuthService;

        $token = $authService->createUserJwt($user, TweetChannel::getChannel());

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render(
                'tweet.index',
                $this->getRelationInfo() + compact('token')
            ),
        ]);
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

            $view = new View();
            return $view->render('layouts.app', [
                'content' => $view->render(
                    'tweet.index',
                    $form + ['errors' => $errors] + $this->getRelationInfo()
                ),
            ]);
        } else {
            // エラーがないとき

            if (! $commit) {
                // 確定以外

                if ($confirm) {
                    // 確認へ遷移するとき

                    $view = new View();
                    return $view->render('layouts.app', [
                        'content' => $view->render(
                            'tweet.confirm',
                            $form + $this->getRelationInfo()
                        ),
                    ]);
                } else {
                    // フォームに戻るとき

                    $view = new View();
                    return $view->render('layouts.app', [
                        'content' => $view->render(
                            'tweet.index',
                            $form + $this->getRelationInfo()
                        ),
                    ]);
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

    /** 関連情報 */
    private function getRelationInfo()
    {
        $tweets = Tweet::query()
            ->scope([Tweet::class, 'kept'])
            ->order("id desc")
            ->limit(10)
            ->all();

        Tweet::withUser($tweets);

        return [
            'tweets' => $tweets,
        ];
    }
}
