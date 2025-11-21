<?php

namespace App\Controllers;

use SFW\Output\View;
use SFW\Core\App;
use SFW\Database\Query;
use SFW\Database\DB;

use App\Services\Sample\SampleService;

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

        $ret = (new Query())->table('users')->where("id = ?", 123)->where("age > ?", 456)->build();
        var_dump($ret);

        // データ取得
        $user = $db->one($ret['sql'], ...$ret['bindings']);
        var_dump($user);

        // 挿入
        $newId = $db->insert(
            'users',
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'age'  => 25
            ]
        );

        // データ取得
        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId);
        var_dump($user);

        $user = $db->one("SELECT * FROM users WHERE id = ?", $newId + 10);
        var_dump($user);

        // 複数取得
        $users = $db->get("SELECT * FROM users WHERE age > ?", 20);
        var_dump($users);

        // 更新
        $rows = $db->update('users', ['age' => 26], 'id = ?' , $newId);
        var_dump($rows);

        // 削除
        $rows = $db->delete('users', 'id = ?' , $newId);
        var_dump($rows);

        $view = new View();
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('devlepment.database_test'),
        ]);
    }
}
