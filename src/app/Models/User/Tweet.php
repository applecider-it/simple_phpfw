<?php

namespace App\Models\User;

use SFW\Database\Query;

use App\Models\Model;
use App\Models\User;

/**
 * ツイートモデル
 */
class Tweet extends Model
{
    protected static string $table = 'user_tweets';

    /** UserとのJoin用のScope */
    public static function scopeUser(Query $query)
    {
        $query->table("INNER JOIN users ON user_tweets.user_id = users.id");
    }

    /** 動作確認用Scope */
    public static function scopeSampleScope(Query $query, $min, $max)
    {
        $query->where(static::$table . '.id > ?', $min);
        $query->where(static::$table . '.id < ?', $max);
    }

    /** 投稿内容のバリデーション */
    public static function validationContent()
    {
        return ['required'];
    }

    /** ユーザーを含める */
    public static function withUser(array &$tweets)
    {
        self::with($tweets, 'user_id', User::query(), 'id', 'user');
    }
}
