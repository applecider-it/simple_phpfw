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
        $query = (new Query(static::$database))->table(static::$table);
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
            static::$table,
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
        $rows = self::db()->update(static::$table, $data, $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

    /**
     * 削除
     * @return int 影響を与えたレコード件数
     */
    public static function delete(int $id): int
    {
        $ret = self::whereSql($id);
        $rows = self::db()->delete(static::$table, $ret['sql'], ...$ret['bindings']);

        return $rows;
    }

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
        $query->where(static::$table . '.' . static::$softDeleteColumn . ' IS NULL');
    }

    /** 論理削除を省くScopeを除去するScope */
    public static function scopeIncludeDeleted(Query $query): void
    {
        $query->removeWhere(static::$table . '.' . static::$softDeleteColumn . ' IS NULL');
    }

    /** 論理削除されているのだけに絞り込むScope */
    public static function scopeDeleted(Query $query): void
    {
        $query->where(static::$table . '.' . static::$softDeleteColumn . ' IS NOT NULL');
    }

    /** WHEREのSQL文 */
    private static function whereSql($id): array
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
     */
    public static function db(): DB
    {
        return App::get(static::$database);
    }

    /**
     * 関連情報を混ぜる
     */
    public static function with(
        array &$rows,
        string $relationColumn,
        Query $relationTableQuery,
        string $relationTableIdColumn,
        string $hashKey
    ): void {
        // 値がない状態でINのクエリーをするとDBエラーになるので終了する
        if (count($rows) === 0) return;

        // リレーションIDだけを配列にする
        $ids = array_unique(array_column($rows, $relationColumn));

        // リレーションテーブルからデータを抽出
        $relationRows = $relationTableQuery
            ->in($relationTableIdColumn . ' IN', $ids)
            ->all();

        // リレーションデータにキーをつける
        $relationRowsHash = array_column($relationRows, null, $relationTableIdColumn);

        // 当てはめる
        foreach ($rows as &$row) {
            $row[$hashKey] = $relationRowsHash[$row[$relationColumn]] ?? null;
        }
    }
}
