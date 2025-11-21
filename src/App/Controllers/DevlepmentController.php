<?php

namespace App\Controllers;

use SFW\Output\View;
use SFW\Core\App;
use SFW\Database\Query;
use SFW\Database\DB;

use App\Services\Sample\SampleService;

use App\Models\User;

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
            'CONTENT' => $view->render('devlepment.index'),
        ]);
    }

    /** viewのテスト */
    public function view_test()
    {
        $sampleService = new SampleService();

        $view = new View();
        $view->data['id'] = 456;
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('devlepment.view_test', [
                'id' => $sampleService->sampleMethod(),
            ]),
        ]);
    }

    /** パラメーターテスト */
    public function param_test($id)
    {
        $view = new View();
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('devlepment.param_test', [
                'id' => $id,
            ]),
        ]);
    }

    /** データベーステスト */
    public function database_test()
    {
        /** @var DB */
        $db = App::get('db');

        $db->tracable = true;

        // 挿入
        $newId = User::insert(
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'age'  => 25
            ]
        );
        var_dump($newId);

        // データ取得
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId);
        print_r($user);
        // 失敗時
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId + 10);
        var_dump($user);

        // 複数取得
        $users = $db->all("SELECT * FROM users WHERE age > ?", 20);
        print_r($users);

        // クエリービルダーで取得
        $ret = (new Query())
            ->table('users')
            ->where("id > ?", 0)
            ->where("age < ?", 100)
            ->order("age desc")
            ->order("email asc")
            ->build();

        print_r($ret);
        $users = $db->all($ret['sql'], ...$ret['bindings']);
        print_r($users);

        // モデルのクエリービルダーで取得
        $ret = User::query()
            ->where("id > ?", 0)
            ->where("age < ?", 100)
            ->order("age desc")
            ->order("email asc")
            ->build();

        print_r($ret);
        $users = $db->all($ret['sql'], ...$ret['bindings']);
        print_r($users);

        // 更新
        $rows = User::update($newId, ['age' => 26]);
        var_dump($rows);

        // モデルでデータ取得
        $user = User::find($newId);
        print_r($user);
        // 失敗時
        $user = User::find($newId + 100);
        var_dump($user);

        // 削除
        $rows = $db->delete('users', 'id = ?', $newId);
        var_dump($rows);

        $view = new View();
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('devlepment.database_test'),
        ]);
    }
}
