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
    private const CONTAINER_KEY = 'adminUser';
    private const ROUTE_OPTION_KEY = 'admin_user';

    /**
     * 認証初期化
     */
    public function initAuth()
    {
        // 管理画面のログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton(self::CONTAINER_KEY, null, '管理画面のログインユーザー');
    }

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
                App::getContainer()->setSingleton(self::CONTAINER_KEY, $adminUser);
            }
        }

        // 認証処理
        if (($currentRoute['options']['auth'] ?? null) === self::ROUTE_OPTION_KEY) {
            if (! App::get(self::CONTAINER_KEY)) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect(Config::get('adminPrefix') . "/login");
            }
        }
    }

    /** ログイン */
    public function login(array $adminUser)
    {
        Session::reflesh();

        Session::set(AdminUser::AUTH_SESSION_KEY, $adminUser["id"]);

        Location::redirect(Config::get('adminPrefix'));
    }

    /** ログアウト */
    public function logout()
    {
        Session::clear(AdminUser::AUTH_SESSION_KEY);

        Location::redirect(Config::get('adminPrefix') . "/login");
    }
}
