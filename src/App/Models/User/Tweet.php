<?php

namespace App\Models\User;

use SFW\Database\Model;
use SFW\Database\Query;

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
