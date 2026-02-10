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
    /**
     * 認証処理実行
     */
    public function execAuth(array $currentRoute)
    {
        // ログインユーザー取得
        $userId = Session::get(User::AUTH_SESSION_KEY);
        if ($userId) {
            $user = User::find($userId);

            if ($user) {
                User::hidden($user);
                App::getContainer()->setSingleton('user', $user);
            }
        }

        // 認証処理
        if (($currentRoute['options']['auth'] ?? null) === 'user') {
            if (! App::get('user')) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect('/login');
            }
        }
    }
}
