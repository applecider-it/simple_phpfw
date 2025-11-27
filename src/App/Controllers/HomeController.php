<?php

namespace App\Controllers;

use SFW\Output\View;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('home.index'),
        ]);
    }
}
