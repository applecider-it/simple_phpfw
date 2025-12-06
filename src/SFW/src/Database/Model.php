<?php

namespace SFW\Database;

use SFW\Core\App;

/**
 * モデルベースクラス
 */
abstract class Model
{
    /** 論理削除用カラム */
    protected static string $softDeleteColumn = 'deleted_at';

    /** プライマリIDカラム名 */
    protected static string $primary = 'id';

    /** テーブル名 */
    protected static string $table = '';

    /** データベースシングルトン名 */
    protected static string $database = 'db';

    /** クエリービルダーを返す */
    public static function query(): Query
    {
        return (new Query(static::$database))->table(static::$table);
    }

    /** ID情報を追加したクエリービルダーを返す */
    public static function queryIncludeId(int $id)
    {
        $ret = self::whereSql($id);
        return self::query()->where($ret['sql'], ...$ret['bindings']);
    }

    /** 取得 */
    public static function find(int $id)
    {
        $queryRet = self::queryIncludeId($id)->build();
        $row = self::db()->one($queryRet['sql'], ...$queryRet['bindings']);

        return $row;
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
            static::$softDeleteColumn => ['NOW()'],
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
    public static function scopeKept(Query $query)
    {
        $query->where(static::$table . '.' . static::$softDeleteColumn . ' IS NULL');
    }

    /** 論理削除されているのだけに絞り込むScope */
    public static function scopeDeleted(Query $query)
    {
        $query->where(static::$table . '.' . static::$softDeleteColumn . ' IS NOT NULL');
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

    /**
     * DB
     * 
     * @return DB;
     */
    public static function db()
    {
        return App::get(static::$database);
    }
}
