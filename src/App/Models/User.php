<?php

namespace App\Models;

/**
 * ユーザーモデル
 */
class User extends ApplicationModel
{
    protected static $table = 'users';

    /** ツイートのクエリービルダー */
    public static function tweets($user_id)
    {
        return User\Tweet::query()
            ->where("user_id = ?", $user_id);
    }
}
