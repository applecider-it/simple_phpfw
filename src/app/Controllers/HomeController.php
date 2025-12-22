<?php

namespace App\Controllers;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        return $this->render('home.index');
    }
}
