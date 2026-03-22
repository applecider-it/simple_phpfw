<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Data\Arr;
use SFW\Core\Lang;
use SFW\Web\Location;
use SFW\Web\Flash;
use SFW\Output\Log;

use function SFW\Helpers\route;

use App\Models\User;
use App\Models\User\Tweet;

use App\Validations\Validator;

use App\Services\Tweet\WebScoketService;
use App\Services\User\AuthService as Auth;

/**
 * ツイートコントローラー
 */
class TweetController extends Controller
{
    /** 一覧画面 */
    public function index()
    {
        $tweets = Tweet::query()
            ->order("id desc")
            ->limit(10)
            ->all();

        Tweet::withUser($tweets);

        return $this->render('tweet.index', compact('tweets'));
    }

    /** 新規作成画面 */
    public function create()
    {
        $initialData = [
            'content' => '',
        ];

        return $this->render('tweet.create', $initialData);
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
            'content' => Lang::get('app.models.user/tweet.attributes.content'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            // エラーがあるとき

            $errors = $v->errors();

            return $this->render('tweet.create', $form + ['errors' => $errors]);
        } else {
            // エラーがないとき

            if (! $commit) {
                // 確定以外

                if ($confirm) {
                    // 確認へ遷移するとき

                    return $this->render('tweet.confirm', $form);
                } else {
                    // フォームに戻るとき

                    return $this->render('tweet.create', $form);
                }
            }
        }

        $user = Auth::get();
        $newId = Tweet::insert(['user_id' => $user['id']] + $form);
        Log::info('New Tweet', [$newId]);

        $webScoketService = new WebScoketService();
        $webScoketService->broadcastTweet($form);

        Flash::set('notice', '投稿しました。');

        Location::redirect(route('tweets.index'));
    }
}
