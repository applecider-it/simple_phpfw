<?php

namespace App\Services\AdminUser;

use SFW\Core\Config;

use App\Models\AdminUser;

use App\Services\Auth\BaseService;

/**
 * 管理者の認証管理
 */
class AuthService extends BaseService
{
    protected static string $containerKey = 'adminUser';
    protected static string $containerDesc = '管理画面のログインユーザー';
    protected static string $routeOptionValue = 'admin_user';
    protected static string $authSessionKey = '___auth___adminUser';

    public function __construct()
    {
        $adminPrefix = Config::get('app.adminPrefix');

        $this->loginUrl = $adminPrefix . '/login';
        $this->afterLoginUrl = $adminPrefix;
        $this->afterLogoutUrl = $adminPrefix . '/login';
        $this->model = AdminUser::class;
    }
}
