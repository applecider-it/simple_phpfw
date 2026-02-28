<?php

declare(strict_types=1);

namespace SFW\Database\Query;

use SFW\Database\Query;

/**
 * クエリービルダーのビルド管理
 */
class Builder
{
    /** カウント取得時の作業用カラム */
    public const WORK_COUNT_COLUMN = 'app_work_cnt';

    /** テーブルラップ時の作業用カラム */
    private const WORK_WRAP_TABLE = 'app_work_tbl';

    /** テーブル用データ配列 */
    private array $tables = [];

    /** Distinctフラグ */
    private bool $distinct = false;

    /** COLUMNS用データ配列 */
    private array $columns = [];

    /** WHERE文用データ配列 */
    private array $wheres = [];

    /** HAVING文用データ配列 */
    private array $havings = [];

    /** ORDER文用データ配列 */
    private array $orders = [];

    /** GROUP文用データ配列 */
    private array $groups = [];

    /** 上限 */
    private int|null $limit = null;

    /** 初期位置 */
    private int|null $offset = null;

    /** データベースシングルトン名 */
    private string $database = 'db';

    function __construct(
        Query $query,
    ) {
        $allData = $query->getAllDatta();

        $this->tables = $allData['tables'];
        $this->distinct = $allData['distinct'];
        $this->columns = $allData['columns'];
        $this->wheres = $allData['wheres'];
        $this->havings = $allData['havings'];
        $this->orders = $allData['orders'];
        $this->groups = $allData['groups'];
        $this->limit = $allData['limit'];
        $this->offset = $allData['offset'];
        $this->database = $allData['database'];
    }

    /** SQLと値をビルドする */
    public function build(bool $buildForCount): array
    {
        // カウント取得じゃないときはそのまま返す
        if (! $buildForCount) return $this->buildSelect($buildForCount);

        /** @var string 作業テーブルでラップする必要があるときはtrue */
        $needWrap = ($this->distinct || $this->groups);

        // 作業テーブルでラップする必要がないときはそのまま返す
        if (! $needWrap) return $this->buildSelect($buildForCount);

        // 作業テーブルでラップする必要があるカウント取得時

        $tableSubquery = $this->buildSelect(false);

        $query = new Query($this->database);

        $query
            ->table(
                "(" . $tableSubquery['sql'] . ") as " . self::WORK_WRAP_TABLE,
                ...$tableSubquery['bindings']
            );

        $builder = new self($query);

        return $builder->buildSelect(true);
    }

    /** SELECT文をビルドする */
    public function buildSelect(bool $buildForCount): array
    {
        $sql = "SELECT";
        $bindings = [];

        if ($this->distinct) {
            $sql .= " DISTINCT";
        }

        if ($buildForCount) {
            $sql .= " count(*) as " . self::WORK_COUNT_COLUMN;
        } else {
            if ($this->columns) {
                $ret = $this->buildColumns();
                $sql .= " " . $ret['sql'];
                $bindings = array_merge($bindings, $ret['bindings']);
            } else {
                $sql .= " *";
            }
        }

        if ($this->tables) {
            $ret = $this->buildTable();
            $sql .= " FROM " . $ret['sql'];
            $bindings = array_merge($bindings, $ret['bindings']);
        }

        if ($this->wheres) {
            $ret = $this->buildWhere();
            $sql .= " WHERE " . $ret['sql'];
            $bindings = array_merge($bindings, $ret['bindings']);
        }

        if ($this->groups) {
            $sql .= " GROUP BY " . implode(", ", $this->groups);
        }

        if ($this->havings) {
            $ret = $this->buildHaving();
            $sql .= " HAVING " . $ret['sql'];
            $bindings = array_merge($bindings, $ret['bindings']);
        }

        if ($this->orders) {
            $sql .= " ORDER BY " . implode(", ", $this->orders);
        }

        if (! $buildForCount) {
            if ($this->limit) $sql .= " LIMIT {$this->limit}";
            if ($this->offset) $sql .= " OFFSET {$this->offset}";
        }

        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
    }

    /** テーブルのビルド */
    private function buildTable(): array
    {
        return $this->buildCommon($this->tables, ' ');
    }

    /** カラムのビルド */
    private function buildColumns(): array
    {
        return $this->buildCommon($this->columns, ', ');
    }

    /** WHERE文のビルド */
    private function buildWhere(): array
    {
        return $this->buildCommon($this->wheres, ' AND ');
    }

    /** HAVING文のビルド */
    private function buildHaving(): array
    {
        return $this->buildCommon($this->havings, ' AND ');
    }

    /** 共通のビルド */
    private function buildCommon(array $conf, string $connector): array
    {
        $sqls = [];
        $bindings = [];

        foreach ($conf as $where) {
            $sqls[] = $where['sql'];
            $bindings = array_merge($bindings, $where['bindings']);
        }

        $sql = implode($connector, $sqls);

        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
    }
}
