<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Output\Log;
use SFW\Data\Json;

use App\Services\Sample\SampleService;
use App\Services\Development\DatabaseService;
use App\Services\Development\ValidationService;
use App\Services\Development\FormService;
use App\Services\Development\JavascriptService;
use App\Services\User\AuthService as Auth;

use App\Validations\Validator;

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
        return $this->render('development.view_test', $this->formData());
    }

    /** viewのテスト(POST処理) */
    public function view_test_post()
    {
        return $this->render(
            'development.view_test',
            [
                'list_val' => $this->params['list_val'],
                'radio_val' => $this->params['radio_val'],
                'datetime_val' => $this->params['datetime_val'],
            ]
                + $this->formData()
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
                'meta' => 'ページにmetaを指定した場合',
                'data' => 'ページにdataを指定した場合',
            ],
            layoutData: ['title' => 'renderのテスト'],
            globalData: ['id' => 456],
            layout: 'development.layouts.render_test',
            //layout: null,
        );
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
        //throw new \Exception("例外テスト");
        echo $val;
        Log::info('このログは出力されない。');
    }

    /** javascriptテスト */
    public function javascript_test()
    {
        return $this->render(
            'development.javascript_test',
            ['formData' => $this->formData()]
        );
    }

    /** javascriptテスト(POST API部分) */
    public function api_post()
    {
        $javascriptService = new JavascriptService;

        $user = Auth::get();

        return $javascriptService->apiPostData($user, $this->params);
    }

    /** javascriptテスト(GET API部分) */
    public function api_get()
    {
        $javascriptService = new JavascriptService;

        $user = Auth::get();

        return $javascriptService->apiGetData($user, $this->params);
    }

    /** javascriptテスト(セッションがないPOST API部分) */
    public function api_post_nosession()
    {
        $javascriptService = new JavascriptService;

        $user = Auth::get();

        return $javascriptService->apiPostNosessionData($user, $this->params);
    }

    /** phpテスト */
    public function php_test()
    {
        $all = App::getContainer()->getAll();
        Log::info('コンテナデータ' . Json::trace($all, true));

        return $this->render('development.complate');
    }

    private function formData()
    {
        $formService = new FormService;
        return $formService->formData();
    }
}
