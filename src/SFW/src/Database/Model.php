<?php

namespace SFW\Database;

use SFW\Core\App;

/**
 * モデルベースクラス
 */
abstract class Model
{
    /** 論理削除用カラム */
    public const softDeleteColumn = 'deleted_at';

    /** プライマリIDカラム名 */
    protected static $primary = 'id';

    /** テーブル名 */
    protected static $table = '';

    /** クエリービルダーを返す */
    public static function query(): Query
    {
        return (new Query())->table(static::$table);
    }

    /** 取得 */
    public static function find(int $id)
    {
        $queryRet = self::queryIncludeId($id)->build();
        $row = self::db()->one($queryRet['sql'], ...$queryRet['bindings']);

        return $row;
    }

    /** 論理削除されたレコードを除外して取得 */
    public static function findKept(int $id)
    {
        $queryRet = self::queryIncludeId($id)
            ->scope([static::class, 'scopeKept'])
            ->build();
        $rows = self::db()->one($queryRet['sql'], ...$queryRet['bindings']);

        return $rows;
    }

    /** ID情報を追加したクエリービルダーを返す */
    private static function queryIncludeId(int $id)
    {
        $ret = self::whereSql($id);
        return self::query()->where($ret['sql'], ...$ret['bindings']);
    }

    /** 追加 */
    public static function insert(array $data)
    {
        $newId = self::db()->insert(
            static::$table,
            $data
        );

        return $newId;
    }

    /** 更新 */
    public static function update(int $id, array $data)
    {
        $ret = self::whereSql($id);
        $rows = self::db()->update(static::$table, $data, $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

    /** 削除 */
    public static function delete(int $id)
    {
        $ret = self::whereSql($id);
        $rows = self::db()->delete(static::$table, $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

    /** 論理削除 */
    public static function softDelete(int $id): int
    {
        $data = [
            self::softDeleteColumn => ['NOW()'],
        ];

        return self::update($id, $data);
    }

    /** 論理削除を省くScope */
    public static function scopeKept(Query $query)
    {
        $query->where(static::$table . '.' . self::softDeleteColumn . ' IS NULL');
    }

    /** WHEREのSQL文 */
    private static function whereSql($id)
    {
        $sql = static::$table . '.' . static::$primary . ' = ?';
        $bindings = [$id];
        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
    }

    /** DB */
    private static function db()
    {
        return App::get('db');
    }
}
