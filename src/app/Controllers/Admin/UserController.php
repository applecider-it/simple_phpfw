<?php

namespace App\Controllers\Admin;

use SFW\Output\View;

use App\Controllers\Controller;

use App\Models\User;

/**
 * ユーザー管理コントローラー
 */
class UserController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        $users = User::query()
            ->order("id desc")
            ->all();

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('admin.user.index', [
                'users' => $users,
            ]),
        ]);
    }
}
