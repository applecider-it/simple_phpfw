<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Output\View;
use SFW\Output\Log;

use App\Services\Sample\SampleService;
use App\Services\Development\DatabaseService;
use App\Services\Development\ValidationService;

use App\Core\Validator;

/**
 * 開発者向けページ
 */
class DevelopmentController extends Controller
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
        $databaseService = new DatabaseService();

        $databaseService->operationCheck();

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.database_test'),
        ]);
    }

    /** バリデーションテスト */
    public function validation_test()
    {
        $validationService = new ValidationService();

        $ret = $validationService->testData();

        $v = Validator::make($ret['data'], $ret['rules'], $ret['labels']);

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

    /** 例外テスト */
    public function exeption_test()
    {
        Log::info('このログは出力される。');
        throw new \Exception("例外テスト");
        Log::info('このログは出力されない。');
    }

    /** 認証テスト */
    public function auth_test()
    {
        Log::info('認証が通ったときだけ、このログは出力される。');

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.auth_test'),
        ]);
    }

    /** frontendテスト */
    public function frontend_test()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.frontend_test'),
        ]);
    }

    /** frontendテスト(POST API部分) */
    public function api_post()
    {
        $user = App::get('user');

        return json_encode(
            [
                'data' => [
                    'user' => $user,
                    'params.aaa' => $this->params['aaa'],
                ]
            ]
        );
    }

    /** frontendテスト(GET API部分) */
    public function api_get()
    {
        $user = App::get('user');

        return json_encode(
            [
                'data' => [
                    'user' => $user,
                    'params.val1' => $this->params['get_val'],
                    '111' => [
                        '222' => [
                            '333' => '444',
                        ]
                    ]
                ]
            ]
        );
    }

    /** frontendテスト(セッションがないPOST API部分) */
    public function api_post_nosession()
    {
        $user = App::get('user');

        return json_encode(
            [
                'data' => [
                    'type' => 'nosession',
                    'user' => $user,
                    'params.aaa' => $this->params['aaa'],
                ]
            ]
        );
    }

    /** デザイン確認画面 */
    public function design()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('development.design'),
        ]);
    }
}
