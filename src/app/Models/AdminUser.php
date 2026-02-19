<?php

namespace App\Models;

/**
 * 管理者モデル
 */
class AdminUser extends Model
{
    protected static string $table = 'admin_users';

    /** Jsonに混ざってはいけないカラムを隠す */
    public static function hidden(array &$user)
    {
        unset($user['password']);
    }
}
