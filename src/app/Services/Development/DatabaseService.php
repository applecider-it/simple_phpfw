<?php

namespace App\Services\Development;

use SFW\Core\App;

use SFW\Output\Log;

use SFW\Database\Query;
use SFW\Database\DB;

use App\Models\User;
use App\Models\User\Tweet;

/**
 * 開発者向けのデータベース関連のサービス
 */
class DatabaseService
{
    /** 動作確認 */
    public function operationCheck()
    {
        /** @var DB */
        $db = App::get('db');

        $password = "passwordpassword";

        $this->drawLine();

        $newId = $this->insert($db, $password);

        $this->drawLine();

        $this->db($db, $newId, $password);

        $this->drawLine();

        $this->query();

        $this->drawLine();

        $this->model($newId);

        $this->drawLine();

        $this->query2($newId);

        $this->drawLine();

        $this->model2($newId);

        $this->drawLine();
    }

    /** 線を出力 */
    private function drawLine()
    {
        Log::info(str_repeat("-", 70));
    }

    /** レコード追加確認 */
    private function insert(DB $db, string $password)
    {
        $db->startTransaction();

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

        return $newId;
    }

    /** DB確認 */
    private function db(DB $db, int $newId, string $password)
    {
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
    }

    /** クエリービルダー確認 */
    private function query()
    {
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
            ->where("id < ?", 20000)
            ->order("id desc")
            ->order("email asc")
            ->all();

        Log::info('クエリービルダーで取得 all', [$users]);
    }

    /** モデル確認 */
    private function model(int $newId)
    {
        // モデルのクエリービルダーで取得
        $query = User::query()
            ->where("id > ?", 0)
            ->where("id < ?", 30000)
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
    }

    /** 複雑なクエリー確認 */
    private function query2(int $newId)
    {
        // サブクエリー用
        $query = (new Query)
            ->table("users users2")
            ->column("COUNT(*)")
            ->where("users2.id = user_tweets.user_id")
            ->where("users2.id > ?", 0)
            ->where("users2.id < ?", 40000);
        $ret = $query->build();
        Log::info('サブクエリー用', $ret);

        // 複雑なクエリーの動作確認
        $tweets = User::tweets($newId)
            ->scope([Tweet::class, 'scopeUser'])
            ->order("user_tweets.id asc")
            ->column("user_tweets.*")
            ->column("users.name as user_name")
            ->column("(" . $ret['sql'] . ") as cnt", ...$ret['bindings'])
            ->where("user_tweets.id < ?", 50000)
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

        // Distinct、when、scope、in動作確認
        $min = 0;
        $max = 9000;
        $tweets = Tweet::query()
            ->distinct()
            ->column("user_id")
            ->when(true, function (Query $query) use ($min, $max) {
                Tweet::scopeSample($query, $min, $max);
            })
            ->where('content NOT LIKE ?', '%aaaa%')
            //->in('user_id IN', [1, 2, 3, 4])
            ->in('user_id NOT IN', [1000, 2000, 3000, 4000])
            ->scope([Tweet::class, 'scopeSample'], 0, 8000)
            ->when(false, function (Query $query) {
                Tweet::scopeSample($query, 10000, 0);
            })
            ->all();

        Log::info('Distinct、when、scope、in動作確認 all', [$tweets]);
    }

    /** モデルの削除確認 */
    private function model2(int $newId)
    {
        // 論理削除
        $rows = User::softDelete($newId);
        Log::info('users 論理削除', [$rows]);
        $user = User::find($newId);
        Log::info('論理削除後再取得', [$user]);
        $user = User::queryIncludeId($newId)
            ->scope([User::class, 'scopeKept'])
            ->one();
        Log::info('論理削除後再取得（論理削除されたのを除外）', [$user]);

        // 物理削除
        // CREATE文に、ON DELETE CASCADEがあるので、関連するuser_tweetsも削除される
        $rows = User::delete($newId);
        Log::info('users 物理削除', [$rows]);
    }
}
