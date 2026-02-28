<?php

declare(strict_types=1);

namespace SFW\Database;

/**
 * 関連テーブル管理
 */
class Relation
{
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
