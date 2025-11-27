<?php

namespace App\Models\User;

use SFW\Database\Query;

use App\Models\Model;

/**
 * ツイートモデル
 */
class Tweet extends Model
{
    protected static $table = 'user_tweets';

    /** 動作確認用Scope */
    public static function scopeSample(Query $query, $min, $max)
    {
        $query->where(static::$table . '.id > ?', $min);
        $query->where(static::$table . '.id < ?', $max);
    }
}
