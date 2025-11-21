<?php

namespace SFW\Database;

use SFW\Core\App;

/**
 * モデルベースクラス
 */
class Model
{
    protected static $primary = 'id';
    protected static $table = '';

    /** クエリービルダーを返す */
    public static function query(): Query
    {
        return (new Query())->table(static::$table);
    }

    /** 取得 */
    public static function find(int $id)
    {
        $ret = self::whereSql($id);
        $queryRet = self::query()->where($ret['sql'], ...$ret['bindings'])->build();
        $rows = self::db()->one($queryRet['sql'], ...$queryRet['bindings']);

        return $rows;
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

    /** WHEREのSQL文 */
    private static function whereSql($id)
    {
        $sql = static::$primary . ' = ?';
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
