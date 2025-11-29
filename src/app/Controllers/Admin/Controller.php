<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller as BaseController;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Routing\Location;

use App\Models\AdminUser;

/**
 * 管理画面のベースコントローラー
 */
abstract class Controller extends BaseController
{
    /** アクション前処理 */
    public function beforeAction()
    {
        parent::beforeAction();

        // ログインユーザー取得
        if (isset($_SESSION["admin_user_id"])) {
            $adminUser = AdminUser::queryIncludeId($_SESSION["admin_user_id"])
                ->one();

            if ($adminUser) {
                App::getContainer()->setSingleton('adminUser', $adminUser);
            }
        }

        // 認証処理
        if ((App::get('router')->currentRoute['options']['auth'] ?? null) === 'admin_user') {
            if (! App::get('adminUser')) {
                Location::redirect(Config::get('adminPrefix') . "/login");
            }
        }
    }
}
