<?php

namespace App\Controllers\Auth;

use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;

use App\Controllers\Controller;

use App\Models\User;

use App\Services\User\AuthService;

/**
 * ログイン管理コントローラー
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

        return $this->render('auth.session.login', $initialData);
    }

    /** ログイン */
    public function post()
    {
        $authService = new AuthService;

        $email = $this->params['email'];
        $password = $this->params['password'];

        $user = User::query()
            ->where('email = ?', $email)
            ->one();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                Log::info('パスワード認証成功');

                $authService->login($user);
            }
        }

        $form = [
            'email' => $email,
            'password' => '',
        ];

        Flash::set('alert', Lang::get('errors.LoginFailed'));

        return $this->render('auth.session.login', $form);
    }

    /** ログアウト */
    public function logout()
    {
        $authService = new AuthService;

        $authService->logout();
    }
}
