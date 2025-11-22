<?php

namespace App\Controllers;

use SFW\Output\View;
use SFW\Output\Log;
use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Database\Query;
use SFW\Database\DB;

use App\Services\Sample\SampleService;

use App\Models\User;
use App\Models\User\Tweet;

use App\Extends\Validator;

/**
 * 開発者向けページ
 */
class DevlepmentController extends ApplicationController
{
    /** トップ画面 */
    public function index()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('devlepment.index'),
        ]);
    }

    /** viewのテスト */
    public function view_test()
    {
        $sampleService = new SampleService();

        $view = new View();
        $view->data['id'] = 456;
        return $view->render('layouts.app', [
            'title' => 'Viewのテスト',
            'content' => $view->render('devlepment.view_test', [
                'id' => $sampleService->sampleMethod(),
                'content' => 'ページにcontentを指定した場合',
            ]),
        ]);
    }

    /** パラメーターテスト */
    public function param_test($id)
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('devlepment.param_test', [
                'id' => $id,
            ]),
        ]);
    }

    /** データベーステスト */
    public function database_test()
    {
        /** @var DB */
        $db = App::get('db');

        // 挿入
        $newId = User::insert(
            [
                'name' => 'Alice',
                'email' => 'alice' . time() . '@example.com',
                'age'  => 25
            ]
        );
        Log::info('After User Insert', [$newId]);

        $newIdTweet = Tweet::insert(
            [
                'user_id' => $newId,
                'content' => 'ツイートテキスト' . time(),
            ]
        );
        Log::info('After User/Tweet Insert', [$newIdTweet]);

        // データ取得
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId);
        Log::info('one', [$user]);

        // 失敗時
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId + 10);
        Log::info('one 失敗', [$user]);

        // 複数取得
        $users = $db->all("SELECT * FROM users WHERE age > ?", 20);
        Log::info('all', [$users]);

        // クエリービルダーで取得
        $query = (new Query())
            ->table('users')
            ->where("id > ?", 0)
            ->where("age < ?", 100)
            ->order("age desc")
            ->order("email asc");

        $ret = $query->build();
        Log::info('クエリービルダーSQL', [$ret]);

        $user = $query->one();
        Log::info('クエリービルダーで取得 one', [$user]);

        $users = (new Query())
            ->table('users')
            ->where("id > ?", 0)
            ->where("age < ?", 100)
            ->order("age desc")
            ->order("email asc")
            ->all();

        Log::info('クエリービルダーで取得 all', [$users]);

        // モデルのクエリービルダーで取得
        $query = User::query()
            ->where("id > ?", 0)
            ->where("age < ?", 100)
            ->order("age desc")
            ->order("email asc");

        $ret = $query->build();
        Log::info('モデルのクエリービルダーSQL', [$ret]);

        $users = $query->all();
        Log::info('モデルのクエリービルダーで取得 all', [$users]);

        // ツイート
        $tweets = User::tweets($newId)
            ->order("id asc")
            ->all();

        Log::info('ツイートをリレーションで取得 all', [$tweets]);

        // 更新
        $rows = User::update($newId, ['age' => 26]);
        Log::info('更新', [$rows]);

        // モデルでデータ取得
        $user = User::find($newId);
        Log::info('更新後再取得', [$user]);

        // 失敗時
        $user = User::find($newId + 100);
        Log::info('find失敗時', [$user]);

        // 削除
        $rows = $db->delete('users', 'id = ?', $newId);
        Log::info('削除', [$rows]);

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('devlepment.database_test'),
        ]);
    }

    /** バリデーションテスト */
    public function validation_test()
    {
        $data = [
            'email' => 'test@example',
            'age' => '',
            'address' => '',
        ];

        $rules = [
            'email' => ['required', 'email'],
            'age' => ['numeric'],
            'address' => ['required'],
        ];

        $labels = [
            'email' => 'メールアドレス',
            'age' => '年齢',
            'address' => '住所',
        ];

        $v = Validator::make($data, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();
        }

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('devlepment.validation_test', [
                'errors' => $errors,
            ]),
        ]);
    }
}
