<?php

namespace App\Controllers;

use SFW\Output\View;

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
}
