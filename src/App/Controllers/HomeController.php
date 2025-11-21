<?php

namespace App\Controllers;

use SFW\Output\View;

/**
 * ホームコントローラー
 */
class HomeController extends ApplicationController
{
    /** トップ画面 */
    public function index()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'CONTENT' => $view->render('home.index'),
        ]);
    }
}
