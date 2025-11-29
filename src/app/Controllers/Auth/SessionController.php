<?php

namespace App\Controllers\Auth;

use SFW\Output\View;
use SFW\Output\Log;
use SFW\Routing\Location;

use App\Controllers\Controller;

use App\Models\User;

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

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('auth.session.login', $initialData),
        ]);
    }

    /** ログイン */
    public function post()
    {
        $email = $this->params['email'];
        $password = $this->params['password'];

        $user = User::query()
            ->scope([User::class, 'kept'])
            ->where('email = ?', $email)
            ->one();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                Log::info('パスワード認証成功');

                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["id"];

                Location::redirect("/");
            }
        }

        $form = [
            'email' => $email,
            'password' => '',
        ];

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('auth.session.login', $form),
        ]);
    }

    /** ログアウト */
    public function logout()
    {
        session_unset();
        session_destroy();

        Location::redirect("/");
    }
}
