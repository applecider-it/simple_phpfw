<?php

namespace App\Controllers;

use SFW\Output\View;

use App\Services\Sample\SampleService;

class HomeController extends ApplicationController
{
    public function index()
    {
        $sampleService = new SampleService();

        $view = new View();
        $view->data['id'] = 456;
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('home.index', [
                'id' => $sampleService->sampleMethod(),
            ]),
        ]);
    }

    public function test($id)
    {
        $view = new View();
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('home.test', [
                'id' => $id,
            ]),
        ]);
    }
}
