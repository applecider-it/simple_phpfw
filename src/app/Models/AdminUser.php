<?php

namespace App\Models;

/**
 * 管理者モデル
 */
class AdminUser extends Model
{
    /** 認証で使うセッションのキー */
    const AUTH_SESSION_KEY = "admin_user_id";

    protected static $table = 'admin_users';
}
