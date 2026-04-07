<?php

declare(strict_types=1);

namespace SFW\Database;

use SFW\Core\App;

/**
 * モデルベースクラス
 */
abstract class Model
{
    /** プライマリIDカラム名 */
    protected static string $primary = 'id';

    /** テーブル名 */
    protected static string $table = '';

    /** データベースシングルトン名 */
    protected static string $database = 'db';

    /** クエリービルダーを返す */
    public static function query(): Query
    {
        $query = (new Query(static::$database))->table(static::table());
        static::defaultScope($query);
        return $query;
    }

    /** 共通に設定されるScope */
    protected static function defaultScope(Query $query) {}

    /** ID情報を追加したクエリービルダーを返す */
    public static function queryIncludeId(int $id): Query
    {
        $ret = self::whereSql($id);
        return self::query()->where($ret['sql'], ...$ret['bindings']);
    }

    /** 取得 */
    public static function find(int $id): array|false
    {
        $queryRet = self::queryIncludeId($id)->build();
        $row = self::db()->one($queryRet['sql'], ...$queryRet['bindings']);

        return $row;
    }

    /**
     * 追加
     * @return int 新しく採番されたID
     */
    public static function insert(array $data): int
    {
        $newId = self::db()->insert(
            static::table(),
            $data
        );

        return $newId;
    }

    /**
     * 更新
     * @return int 影響を与えたレコード件数
     */
    public static function update(int $id, array $data): int
    {
        $ret = self::whereSql($id);
        $rows = self::db()->update(static::table(), $data, $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

    /**
     * 削除
     * @return int 影響を与えたレコード件数
     */
    public static function delete(int $id): int
    {
        $ret = self::whereSql($id);
        $rows = self::db()->delete(static::table(), $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

    /** WHEREのSQL文 */
    private static function whereSql($id): array
    {
        $sql = static::table() . '.' . static::$primary . ' = ?';
        $bindings = [$id];
        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
    }

    /** DB */
    public static function db(): DB
    {
        return App::get(static::$database);
    }

    /** Table */
    public static function table(): string
    {
        return static::$table;
    }
}
