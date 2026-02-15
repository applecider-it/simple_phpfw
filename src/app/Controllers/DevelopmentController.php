<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Output\Log;
use SFW\Data\Json;

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
        return $this->render('development.index');
    }

    /** viewのテスト */
    public function view_test()
    {
        return $this->render('development.view_test', $this->view_test_common());
    }
    public function view_test_post()
    {
        return $this->render(
            'development.view_test',
            [
                'list_val' => $this->params['list_val'],
                'radio_val' => $this->params['radio_val'],
                'datetime_val' => $this->params['datetime_val'],
            ]
                + $this->view_test_common()
        );
    }
    private function view_test_common()
    {
        $list_val = 2;
        $radio_val = 'val2';
        $datetime_val = '2026-02-15T14:30';
        $list_vals = [
            1 => 'No. 1',
            2 => 'No. 2',
            3 => 'No. 3',
        ];
        $radio_vals = [
            'val1' => 'Value 1',
            'val2' => 'Value 2',
        ];
        return compact(
            'list_val',
            'radio_val',
            'datetime_val',
            'list_vals',
            'radio_vals'
        );
    }

    /** renderのテスト */
    public function render_test()
    {
        $sampleService = new SampleService();

        return $this->render(
            'development.render_test',
            [
                'id' => $sampleService->sampleMethod(),
                'content' => 'ページにcontentを指定した場合',
            ],
            layoutData: ['title' => 'Viewのテスト'],
            globalData: ['id' => 456],
            layout: 'layouts.view_test',
            //layout: null,
        );
    }

    /** パラメーターテスト */
    public function param_test()
    {
        return $this->render('development.param_test', [
            'id' => $this->params['id'],
            'val1' => $this->params['val1'],
        ]);
    }

    /** データベーステスト */
    public function database_test()
    {
        $databaseService = new DatabaseService();

        $databaseService->operationCheck();

        return $this->render('development.database_test');
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

        return $this->render('development.validation_test', compact('errors'));
    }

    /** 例外テスト */
    public function exeption_test()
    {
        Log::info('このログは出力される。');
        throw new \Exception("例外テスト");
        Log::info('このログは出力されない。');
    }

    /** javascriptテスト */
    public function javascript_test()
    {
        return $this->render('development.javascript_test');
    }

    /** javascriptテスト(POST API部分) */
    public function api_post()
    {
        $user = App::get('user');

        return [
            'data' => [
                'user' => $user,
                'params.aaa' => $this->params['aaa'],
            ]
        ];
    }

    /** javascriptテスト(GET API部分) */
    public function api_get()
    {
        $user = App::get('user');

        return [
            'data' => [
                'user' => $user,
                'params.val1' => $this->params['get_val'],
                '111' => [
                    '222' => [
                        '333' => '444',
                    ]
                ]
            ]
        ];
    }

    /** javascriptテスト(セッションがないPOST API部分) */
    public function api_post_nosession()
    {
        $user = App::get('user');

        return [
            'data' => [
                'type' => 'nosession',
                'user' => $user,
                'params.aaa' => $this->params['aaa'],
            ]
        ];
    }

    /** デザイン確認画面 */
    public function design()
    {
        return $this->render('development.design');
    }

    /** phpテスト */
    public function php_test()
    {
        $all = App::getContainer()->getAll();
        Log::info('コンテナデータ' . Json::trace($all, true));

        return $this->render('development.complate');
    }
}
