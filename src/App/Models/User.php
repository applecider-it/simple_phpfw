<?php

namespace App\Models;

use SFW\Database\Model;

/**
 * ユーザーモデル
 */
class User extends Model
{
    protected static $table = 'users';

    /** ツイートのクエリービルダー */
    public static function tweets($user_id)
    {
        return User\Tweet::query()
            ->where("user_id = ?", $user_id);
    }
}
