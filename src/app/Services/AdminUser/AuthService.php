<?php

namespace App\Services\AdminUser;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Core\Lang;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;

use App\Models\AdminUser;

/**
 * 管理者の認証管理
 */
class AuthService
{
    /**
     * 認証処理実行
     */
    public function execAuth(array $currentRoute)
    {
        // ログインユーザー取得
        $adminUserId = Session::get(AdminUser::AUTH_SESSION_KEY);
        if ($adminUserId) {
            $adminUser = AdminUser::queryIncludeId($adminUserId)
                ->one();

            if ($adminUser) {
                App::getContainer()->setSingleton('adminUser', $adminUser);
            }
        }

        // 認証処理
        if (($currentRoute['options']['auth'] ?? null) === 'admin_user') {
            if (! App::get('adminUser')) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect(Config::get('adminPrefix') . "/login");
            }
        }
    }
}
