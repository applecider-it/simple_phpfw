<?php

namespace App\Controllers\Admin\Auth;

use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;
use SFW\Core\Config;

use App\Controllers\Admin\Controller;

use App\Models\AdminUser;

use App\Services\AdminUser\AuthService;

/**
 * 管理者ログイン管理コントローラー
 */
class SessionController extends Controller
{
    /** ログイン画面 */
    public function login()
    {
        $initialData = [
            'email' => '',
            'password' => '',
        ];

        return $this->render('admin.auth.session.login', $initialData);
    }

    /** ログイン */
    public function post()
    {
        $authService = new AuthService;

        $email = $this->params['email'];
        $password = $this->params['password'];

        $adminUser = AdminUser::query()
            ->where('email = ?', $email)
            ->one();

        if ($adminUser) {
            if (password_verify($password, $adminUser['password'])) {
                Log::info('パスワード認証成功');

                $authService->login($adminUser);
            }
        }

        $form = [
            'email' => $email,
            'password' => '',
        ];

        Flash::set('alert', Lang::get('errors.LoginFailed'));

        return $this->render('admin.auth.session.login', $form);
    }

    /** ログアウト */
    public function logout()
    {
        $authService = new AuthService;

        $authService->logout();
    }
}
