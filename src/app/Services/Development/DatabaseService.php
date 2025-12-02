<?php

namespace App\Services\Development;

use SFW\Core\App;

use SFW\Output\Log;

use SFW\Database\Query;
use SFW\Database\DB;

use App\Models\User;
use App\Models\User\Tweet;

use App\ModelsAnother\Another;

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

        $this->modelAnother();

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

        $tweetCount = 2;
        foreach (range(1, $tweetCount) as $number) {
            $newIdTweet = Tweet::insert(
                [
                    'user_id' => $newId,
                    'created_at' => ['NOW()'],
                    'content' => 'ツイートテキスト No.' . $number,
                ]
            );
            Log::info('After User/Tweet Insert', [$newIdTweet]);
        }

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
        // columnサブクエリー用
        $columnSubquery = (new Query)
            ->table("users users2")
            ->where("users2.id = user_tweets.user_id")
            ->where("users2.id > ?", 0)
            ->where("users2.id < ?", 40000)
            ->build(true);
        Log::info('columnサブクエリー用', $columnSubquery);

        // whereサブクエリー用
        $whereSubquery = (new Query)
            ->table("users users3")
            ->column("users3.id")
            ->where("users3.id > ?", 0)
            ->where("users3.id < ?", 45000)
            ->build();
        Log::info('whereサブクエリー用', $whereSubquery);

        // 複雑なクエリーの動作確認
        $tweets = User::tweets($newId)
            ->scope([Tweet::class, 'user'])
            ->order("user_tweets.id asc")
            ->column("user_tweets.*")
            ->column("users.name as user_name")
            ->column("(" . $columnSubquery['sql'] . ") as cnt", ...$columnSubquery['bindings'])
            ->where("user_tweets.id < ?", 50000)
            ->where("user_tweets.user_id in (" . $whereSubquery['sql'] . ")", ...$whereSubquery['bindings'])
            ->limit(100)
            ->offset(1)
            ->all();

        Log::info('複雑なクエリーの動作確認 all', [$tweets]);

        // Group Having動作確認
        $query = Tweet::query()
            ->column("user_id")
            ->column("count(*) as cnt")
            ->group("user_id")
            //->having("cnt > ?", 1)
            ->having("cnt < ?", 1000)
            ->order("cnt")
            ->order("user_id");

        $tweets = $query->all();

        Log::info('Group Having動作確認 all', [$tweets]);

        $cnt = $query->count();

        Log::info('Group Having動作確認 count', [$cnt]);

        // Distinct、when、scope、in動作確認
        $min = 0;
        $max = 9000;
        $query = Tweet::query()
            ->distinct()
            ->column("user_id")
            ->when(true, function (Query $query) use ($min, $max) {
                Tweet::scopeSampleScope($query, $min, $max);
            })
            ->where('content NOT LIKE ?', '%aaaa%')
            //->in('user_id IN', [1, 2, 3, 4])
            ->in('user_id NOT IN', [1000, 2000, 3000, 4000])
            ->scope([Tweet::class, 'sampleScope'], 0, 8000)
            ->when(false, function (Query $query) { // whenの$conditionがfalseの時
                Tweet::scopeSampleScope($query, 10000, 0);
            });

        $tweets = $query->all();

        Log::info('Distinct、when、scope、in動作確認 all', [$tweets]);

        $cnt = $query->count();

        Log::info('Distinct、when、scope、in動作確認 count', [$cnt]);
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
            ->scope([User::class, 'kept'])
            ->one();
        Log::info('論理削除後再取得（論理削除されたのを除外）', [$user]);

        // 物理削除
        // CREATE文に、ON DELETE CASCADEがあるので、関連するuser_tweetsも削除される
        $rows = User::delete($newId);
        Log::info('users 物理削除', [$rows]);
    }

    /** 外部DBのモデル確認 */
    private function modelAnother()
    {
        // 挿入
        $newId = Another::insert(
            [
                'name' => '外部テスト',
            ]
        );
        Log::info('外部DBのモデル After Insert', [$newId]);

        // モデルのクエリービルダーで取得
        $anothers = Another::query()
            ->where("id > ?", 0)
            ->order("name asc")
            ->all();

        Log::info('外部DBのモデル all', [$anothers]);

        // 更新
        $rows = Another::update($newId, [
            'name' => '外部テスト2',
        ]);
        Log::info('外部DBのモデル 更新', [$rows]);

        // モデルでデータ取得
        $another = Another::find($newId);
        Log::info('外部DBのモデル 更新後再取得', [$another]);

        $rows = Another::delete($newId);
        Log::info('外部DBのモデル 物理削除', [$rows]);
    }
}
