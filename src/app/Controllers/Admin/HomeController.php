<?php

namespace App\Controllers\Admin;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        return $this->render('admin.home.index', layout: 'admin.layouts.app');
    }
}
