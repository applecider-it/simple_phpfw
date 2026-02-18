<?php

namespace App\Services\User;

use App\Models\User;

use App\Services\Auth\BaseService;

/**
 * ユーザーの認証管理
 */
class AuthService extends BaseService
{
    protected static string $containerKey = 'user';
    protected static string $containerDesc = 'ログインユーザー';
    protected static string $routeOptionValue = 'user';

    public function __construct()
    {
        $this->loginUrl = '/login';
        $this->afterLoginUrl = '/';
        $this->afterLogoutUrl = '/';
        $this->authSessionKey = User::AUTH_SESSION_KEY;
        $this->model = User::class;
    }
}
