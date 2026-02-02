<?php

namespace App\Models;

use SFW\Database\Raw;
use SFW\Database\Query;

/**
 * ユーザーモデル
 * 
 * ドキュメント
 * /documents/Models/User.md
 */
class User extends Model
{
    /** 認証で使うセッションのキー */
    const AUTH_SESSION_KEY = "user_id";

    protected static string $table = 'users';

    protected static function defaultScope(Query $query) {
        $query->scope([self::class, 'kept']);
    }

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

    /** Jsonに混ざってはいけないカラムを隠す */
    public static function hidden(array &$user)
    {
        unset($user['password']);
        unset($user['deleted_at']);
    }

    /** 関連テーブル削除 */
    public static function deleteRelations(int $id)
    {
        $db = self::db();
        
        $db->update('user_tweets', [User\Tweet::$softDeleteColumn => new Raw('NOW()')], 'user_id = ?', $id);
    }
}
