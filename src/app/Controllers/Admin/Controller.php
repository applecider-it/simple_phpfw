<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller as BaseController;

use SFW\Core\App;

use App\Services\AdminUser\AuthService;

/**
 * 管理画面のベースコントローラー
 */
abstract class Controller extends BaseController
{
    /** アクション前処理 */
    public function beforeAction()
    {
        parent::beforeAction();

        $authService = new AuthService();

        $currentRoute = App::get('router')->currentRoute();

        $authService->execAuth($currentRoute);
    }
}
