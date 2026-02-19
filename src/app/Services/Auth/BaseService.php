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
    /** ユーザーデータを保管するサービスコンテナのキー */
    protected static string $containerKey = '';
    /** ユーザーデータを保管するサービスコンテナの説明 */
    protected static string $containerDesc = '';

    /** 認証必須を判別するルートのオプションの値 */
    protected static string $routeOptionValue = '';

    /** ログインページのURL */
    protected string $loginUrl = '';
    /** ログイン後に遷移するページのURL */
    protected string $afterLoginUrl = '';
    /** ログアウト後に遷移するページのURL */
    protected string $afterLogoutUrl = '';

    /** ログインユーザーIDを保管するセッションのキー */
    protected string $authSessionKey = '';

    /** 認証で利用するモデル */
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
            // セッションに値があるとき

            $user = "{$this->model}"::find($userId);

            if ($user) {
                // 有効なデータがDBにあるとき

                // 秘匿データを隠す
                "{$this->model}"::hidden($user);

                App::getContainer()->setSingleton(static::$containerKey, $user);
            }
        }

        // 認証確認処理
        if (($currentRoute['options']['auth'] ?? null) === static::$routeOptionValue) {
            // 認証必須ページの時

            if (! self::get()) {
                // 認証していないとき

                Flash::set('alert', Lang::get('errors.loginRequired'));

                Location::redirect($this->loginUrl);
            }
        }
    }

    /** ログイン処理 */
    public function authenticate(string $email, string $password)
    {
        $user = "{$this->model}"::query()
            ->where('email = ?', $email)
            ->one();

        if ($user) {
            // 有効なデータがDBにあるとき

            if (Hash::check($password, $user['password'])) {
                // パスワードが有効な時

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
