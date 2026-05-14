<?php

declare(strict_types=1);

namespace SFW\Database\Model;

use SFW\Database\Query;
use SFW\Database\Raw;

/**
 * 論理削除トレイト
 * 
 * @method static int update(int $id, array $data)
 * @method static string table()
 */
trait SoftDelete
{
    /** 論理削除用カラム */
    protected static string $softDeleteColumn = 'deleted_at';

    /**
     * 論理削除
     * @return int 影響を与えたレコード件数
     */
    public static function softDelete(int $id): int
    {
        $data = [
            static::$softDeleteColumn => new Raw('NOW()'),
        ];

        return self::update($id, $data);
    }

    /** 復元 */
    public static function restore(int $id): int
    {
        $data = [
            static::$softDeleteColumn => null,
        ];

        return self::update($id, $data);
    }

    /** 論理削除を省くScope */
    public static function scopeKept(Query $query): void
    {
        $query->where(static::table() . '.' . static::$softDeleteColumn . ' IS NULL');
    }

    /** 論理削除を省くScopeを除去するScope */
    public static function scopeIncludeDeleted(Query $query): void
    {
        $query->removeWhere(static::table() . '.' . static::$softDeleteColumn . ' IS NULL');
    }

    /** 論理削除されているのだけに絞り込むScope */
    public static function scopeDeleted(Query $query): void
    {
        $query->where(static::table() . '.' . static::$softDeleteColumn . ' IS NOT NULL');
    }

    /** softDeleteColumn */
    public static function softDeleteColumn(): string
    {
        return static::$softDeleteColumn;
    }
}
