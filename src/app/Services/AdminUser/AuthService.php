<?php

namespace App\Services\AdminUser;

use SFW\Core\Config;
use function SFW\Helpers\route;

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
        $this->loginUrl = route('admin.login');
        $this->afterLoginUrl = route('admin.index');
        $this->afterLogoutUrl = route('admin.login');
        $this->model = AdminUser::class;
    }
}
