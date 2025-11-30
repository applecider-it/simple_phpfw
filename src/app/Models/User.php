<?php

namespace App\Models;

/**
 * ユーザーモデル
 */
class User extends Model
{
    /** 認証で使うセッションのキー */
    const AUTH_SESSION_KEY = "user_id";

    protected static $table = 'users';

    /** ツイートのクエリービルダー */
    public static function tweets($user_id)
    {
        return User\Tweet::query()
            ->where("user_id = ?", $user_id);
    }

    /** 名前のバリデーション */
    public static function validationName()
    {
        return ['required'];
    }

    /** メールアドレスのバリデーション */
    public static function validationEmail(?array $user = null)
    {
        $id = $user['id'] ?? null;

        $query = self::query();
        if ($id) $query->where('id != ?', $id); 

        return ['required', 'email', ['unique', 'email', $query]];
    }

    /** パスワードのバリデーション */
    public static function validationPassword()
    {
        return ['required', 'confirm'];
    }
}
