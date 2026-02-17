<?php

namespace App\Services\User;

use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;

use App\Models\User;

/**
 * ユーザーの認証管理
 */
class AuthService
{
    private const CONTAINER_KEY = 'user';
    private const ROUTE_OPTION_KEY = 'user';

    /** 認証初期化 */
    public function initAuth()
    {
        // ログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton(self::CONTAINER_KEY, null, 'ログインユーザー');
    }

    /** 認証処理実行 */
    public function execAuth(array $currentRoute)
    {
        // ログインユーザー取得
        $userId = Session::get(User::AUTH_SESSION_KEY);
        if ($userId) {
            $user = User::find($userId);

            if ($user) {
                User::hidden($user);
                App::getContainer()->setSingleton(self::CONTAINER_KEY, $user);
            }
        }

        // 認証処理
        if (($currentRoute['options']['auth'] ?? null) === self::ROUTE_OPTION_KEY) {
            if (! App::get(self::CONTAINER_KEY)) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect('/login');
            }
        }
    }

    /** ログイン */
    public function login(array $user)
    {
        Session::reflesh();

        Session::set(User::AUTH_SESSION_KEY, $user["id"]);

        Location::redirect("/");
    }

    /** ログアウト */
    public function logout()
    {
        Session::clear(User::AUTH_SESSION_KEY);

        Location::redirect("/");
    }
}
