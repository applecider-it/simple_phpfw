<?php

namespace App\Controllers\Admin\Auth;

use SFW\Output\View;
use SFW\Output\Log;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;
use SFW\Core\Config;

use App\Controllers\Admin\Controller;

use App\Models\AdminUser;

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

        $view = new View();
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.auth.session.login', $initialData),
        ]);
    }

    /** ログイン */
    public function post()
    {
        $email = $this->params['email'];
        $password = $this->params['password'];

        $adminUser = AdminUser::query()
            ->where('email = ?', $email)
            ->one();

        if ($adminUser) {
            if (password_verify($password, $adminUser['password'])) {
                Log::info('パスワード認証成功');

                Session::reflesh();

                Session::set(AdminUser::AUTH_SESSION_KEY, $adminUser["id"]);

                Location::redirect(Config::get('adminPrefix'));
            }
        }

        $form = [
            'email' => $email,
            'password' => '',
        ];

        Flash::set('alert', 'ログイン失敗。');

        $view = new View();
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.auth.session.login', $form),
        ]);
    }

    /** ログアウト */
    public function logout()
    {
        Session::clear(AdminUser::AUTH_SESSION_KEY);

        Location::redirect(Config::get('adminPrefix') . "/login");
    }
}
