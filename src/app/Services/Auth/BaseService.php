<?php

namespace App\Services\Auth;

use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;
use SFW\Security\Hash;

/**
 * 認証管理のベースクラス
 */
abstract class BaseService
{
    protected static string $containerKey = '';
    protected static string $containerDesc = '';
    protected static string $routeOptionValue = '';

    protected string $loginUrl = '';
    protected string $afterLoginUrl = '';
    protected string $afterLogoutUrl = '';
    protected string $authSessionKey = '';
    protected string $model = '';

    /** 認証初期化 */
    public function initAuth()
    {
        // ログインユーザー情報の入れ物を作る
        App::getContainer()->setSingleton(static::$containerKey, null, static::$containerDesc);
    }

    /** 認証処理実行 */
    public function execAuth(array $currentRoute)
    {
        // ログインユーザー取得
        $userId = Session::get($this->authSessionKey);
        if ($userId) {
            $user = "{$this->model}"::find($userId);

            if ($user) {
                "{$this->model}"::hidden($user);
                App::getContainer()->setSingleton(static::$containerKey, $user);
            }
        }

        // 認証処理
        if (($currentRoute['options']['auth'] ?? null) === static::$routeOptionValue) {
            if (! self::get()) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect($this->loginUrl);
            }
        }
    }

    /** ログイン処理 */
    public function authenticate(string $email, string $password) {
        $user = "{$this->model}"::query()
            ->where('email = ?', $email)
            ->one();

        if ($user) {
            if (Hash::check($password, $user['password'])) {
                Log::info('パスワード認証成功');

                $this->login($user);
            }
        }
    }

    /** ログイン */
    private function login(array $user)
    {
        Session::reflesh();

        Session::set($this->authSessionKey, $user["id"]);

        Location::redirect($this->afterLoginUrl);
    }

    /** ログアウト */
    public function logout()
    {
        Session::clear($this->authSessionKey);

        Location::redirect($this->afterLogoutUrl);
    }

    /** 認証結果取得 */
    public static function get()
    {
        return App::get(static::$containerKey);
    }
}
