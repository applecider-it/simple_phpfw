<?php

namespace App\Controllers\Admin;

use SFW\Output\View;

use App\Controllers\Controller;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        $view = new View();
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.home.index'),
        ]);
    }
}
