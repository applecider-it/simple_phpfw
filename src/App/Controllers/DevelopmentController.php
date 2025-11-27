<?php

namespace App\Controllers;

use SFW\Output\View;
use SFW\Output\Log;
use SFW\Core\App;

use SFW\Database\Query;
use SFW\Database\DB;

use App\Services\Sample\SampleService;

use App\Models\User;
use App\Models\User\Tweet;

use App\Core\Validator;

/**
 * 開発者向けページ
 */
class DevelopmentController extends ApplicationController
{
    /** トップ画面 */
    public function index()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.index'),
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
            'content' => $view->render('development.view_test', [
                'id' => $sampleService->sampleMethod(),
                'content' => 'ページにcontentを指定した場合',
            ]),
        ]);
    }

    /** パラメーターテスト */
    public function param_test()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.param_test', [
                'id' => $this->params['id'],
                'val1' => $this->params['val1'],
            ]),
        ]);
    }

    /** データベーステスト */
    public function database_test()
    {
        /** @var DB */
        $db = App::get('db');

        $db->startTransaction();

        $password = "passwordpassword";

        // 挿入
        $newId = User::insert(
            [
                'name' => 'テスト',
                'email' => 'test' . time() . '@example.com',
                'password'  => password_hash($password, PASSWORD_DEFAULT)
            ]
        );
        Log::info('After User Insert', [$newId]);

        $newIdTweet = Tweet::insert(
            [
                'user_id' => $newId,
                'created_at' => ['NOW()'],
                'content' => 'ツイートテキスト' . time(),
            ]
        );
        Log::info('After User/Tweet Insert', [$newIdTweet]);

        $db->commitTransaction();
        //$db->rollbackTransaction();

        // データ取得
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId);
        Log::info('one', [$user]);

        if (password_verify($password, $user['password'])) {
            Log::info('パスワード認証成功');
        } else {
            Log::info('パスワード認証失敗');
        }

        // 失敗時
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId + 10);
        Log::info('one 失敗', [$user]);

        // 複数取得
        $users = $db->all("SELECT * FROM users WHERE id > ?", 0);
        Log::info('all', [$users]);

        // クエリービルダーで取得
        $query = (new Query())
            ->table('users')
            ->where("id > ?", 0)
            ->where("id < ?", 10000)
            ->order("id desc")
            ->order("email asc");

        $ret = $query->build();
        Log::info('クエリービルダーSQL', [$ret]);

        $user = $query->one();
        Log::info('クエリービルダーで取得 one', [$user]);

        $users = (new Query())
            ->table('users')
            ->where("id > ?", 0)
            ->where("id < ?", 10000)
            ->order("id desc")
            ->order("email asc")
            ->all();

        Log::info('クエリービルダーで取得 all', [$users]);

        // モデルのクエリービルダーで取得
        $query = User::query()
            ->where("id > ?", 0)
            ->where("id < ?", 10000)
            ->order("id desc")
            ->order("email asc");

        $ret = $query->build();
        Log::info('モデルのクエリービルダーSQL', [$ret]);

        $users = $query->all();
        Log::info('モデルのクエリービルダーで取得 all', [$users]);

        // 更新
        $rows = User::update($newId, [
            'name' => 'テスト2',
            'updated_at' => ['NOW()'],
            'password' => password_hash('aaaaaa', PASSWORD_DEFAULT),
        ]);
        Log::info('更新', [$rows]);

        // モデルでデータ取得
        $user = User::find($newId);
        Log::info('更新後再取得', [$user]);

        // 失敗時
        $user = User::find($newId + 100);
        Log::info('find失敗時', [$user]);

        // サブクエリー用
        $query = (new Query)
            ->table("users users2")
            ->column("COUNT(*)")
            ->where("users2.id = user_tweets.user_id")
            ->where("users2.id > ?", 0)
            ->where("users2.id < ?", 10000);
        $ret = $query->build();
        Log::info('サブクエリー用', $ret);

        // 複雑なクエリーの動作確認
        $tweets = User::tweets($newId)
            ->table("INNER JOIN users ON user_tweets.user_id = users.id")
            ->order("user_tweets.id asc")
            ->column("user_tweets.*")
            ->column("users.name as user_name")
            ->column("(" . $ret['sql'] . ") as cnt", ...$ret['bindings'])
            ->limit(100)
            //->offset(10)
            ->all();

        Log::info('複雑なクエリーの動作確認 all', [$tweets]);

        // Group Having動作確認
        $tweets = Tweet::query()
            ->column("user_id")
            ->column("count(*) as cnt")
            ->group("user_id")
            //->having("cnt > ?", 1)
            ->having("cnt < ?", 1000)
            ->order("cnt")
            ->order("user_id")
            ->all();

        Log::info('Group Having動作確認 all', [$tweets]);

        // Distinct、when、scope動作確認
        $min = 0;
        $max = 9000;
        $tweets = Tweet::query()
            ->distinct()
            ->column("user_id")
            ->when(true, function (Query $query) use ($min, $max) {
                Tweet::scopeSample($query, $min, $max);
            })
            ->scope([Tweet::class, 'scopeSample'], 0, 8000)
            ->when(false, function (Query $query) {
                Tweet::scopeSample($query, 10000, 0);
            })
            ->all();

        Log::info('Distinct、when、scope動作確認 all', [$tweets]);

        // 論理削除
        $rows = User::softDelete($newId);
        Log::info('users 論理削除', [$rows]);
        $user = User::find($newId);
        Log::info('論理削除後再取得', [$user]);
        $user = User::findKept($newId);
        Log::info('論理削除後再取得（論理削除されたのを除外）', [$user]);

        // 削除
        // CREATE文に、ON DELETE CASCADEがあるので、関連するuser_tweetsも削除される
        $rows = User::delete($newId);
        Log::info('users 削除', [$rows]);

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.database_test'),
        ]);
    }

    /** バリデーションテスト */
    public function validation_test()
    {
        $data = [
            'originaltest' => 'a',
            'emailtest' => 'testexample.com',
            'numerictest' => '1a23',
            'requiredtest' => '',
            'mintest' => '12',
            'maxtest' => '11',
            'confirmtest' => 'abcd',
            'confirmtest_confirm' => 'abxcd',
        ];

        $rules = [
            'originaltest' => ['original:emailtest,numerictest'],
            'emailtest' => ['required', 'email'],
            'numerictest' => ['numeric'],
            'requiredtest' => ['required'],
            'mintest' => ['required', 'numeric', 'min:10'],
            'maxtest' => ['max:10'],
            'confirmtest' => ['confirm'],
        ];

        $labels = [
            'originaltest' => 'オリジナルテスト',
            'emailtest' => 'メールアドレステスト',
            'numerictest' => '数値テスト',
            'requiredtest' => '空白テスト',
            'mintest' => '最小値テスト',
            'maxtest' => '最大値テスト',
            'confirmtest' => '確認テスト',
        ];

        $v = Validator::make($data, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();
        }

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.validation_test', [
                'errors' => $errors,
            ]),
        ]);
    }

    /** jsonテスト */
    public function json_test()
    {
        return json_encode(
            [
                'data' => [
                    'user' => [
                        'id' => 1,
                        'name' => 'jsonテスト'
                    ]
                ]
            ]
        );
    }

    /** 例外テスト */
    public function exeption_test()
    {
        Log::info('このログは出力される。');
        throw new \Exception("例外テスト");
        Log::info('このログは出力されない。');
    }
}
