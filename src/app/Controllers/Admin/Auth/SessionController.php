<?php

namespace App\Controllers\Admin\Auth;

use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Flash;

use App\Controllers\Admin\Controller;

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

        $authService->authenticate($email, $password);

        $form = [
            'email' => $email,
            'password' => '',
        ];

        Flash::set('alert', Lang::get('app.errors.LoginFailed'));

        return $this->render('admin.auth.session.login', $form);
    }

    /** ログアウト */
    public function logout()
    {
        $authService = new AuthService;

        $authService->logout();
    }
}
