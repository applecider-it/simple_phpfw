<?php

namespace SFW\Database;

use SFW\Core\App;

/**
 * クエリービルダー
 */
class Query
{
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

    /** テーブル指定 */
    public function table(string $table): self
    {
        $this->tables[] = $table;
        return $this;
    }

    /** Distinctを有効にする */
    public function distinct(): self
    {
        $this->distinct = true;
        return $this;
    }

    /** COLUMN追加 */
    public function column(string $sql, ...$value): self
    {
        $this->columns[] = [
            'sql' => $sql,
            'bindings' => $value,
        ];
        return $this;
    }

    /** Where追加 */
    public function where(string $sql, ...$value): self
    {
        $this->wheres[] = [
            'sql' => $sql,
            'bindings' => $value,
        ];
        return $this;
    }

    /** INやNOT IN */
    public function in(string $sql, array $data): self
    {
        $this->where($sql . ' (' . implode(', ', array_fill(0, count($data), '?')) . ')', ...$data);
        return $this;
    }

    /** Having追加 */
    public function having(string $sql, ...$value): self
    {
        $this->havings[] = [
            'sql' => $sql,
            'bindings' => $value,
        ];
        return $this;
    }

    /** order追加 */
    public function order(string $sql): self
    {
        $this->orders[] = $sql;
        return $this;
    }

    /** group追加 */
    public function group(string $sql): self
    {
        $this->groups[] = $sql;
        return $this;
    }

    /** 上限指定 */
    public function limit(int|null $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /** 初期位置指定 */
    public function offset(int|null $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /** $conditionがtrueの時だけクロージャー適用 */
    public function when($condition, \Closure $func): self
    {
        if ($condition) {
            $func($this);
        }
        return $this;
    }

    /**
     * スコープ適用
     * 
     * 例：
     * $scopeが[User::class, 'exampleScope']の場合、User::scopeExampleScopeというクラスメソッドを使う。
     */
    public function scope(array $scope, ...$params): self
    {
        [$class, $name] = $scope;
        $method = 'scope' . ucfirst($name);
        $classMethod = $class . '::' . $method;
        $classMethod($this, ...$params);
        return $this;
    }

    /** SQLと値をビルドする */
    public function build($buildForCount = false)
    {
        $sql = "SELECT";
        $bindings = [];

        if ($this->distinct) {
            $sql .= " DISTINCT";
        }

        if ($buildForCount) {
            $sql .= " count(*) as cnt";
        } else {
            if ($this->columns) {
                $ret = $this->buildColumns();
                $sql .= " " . $ret['sql'];
                $bindings = array_merge($bindings, $ret['bindings']);
            } else {
                $sql .= " *";
            }
        }

        $sql .= " FROM " . implode(" ", $this->tables);

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

    /** カウントする */
    public function count()
    {
        $ret = $this->build(true);

        $row = $this->db()->one($ret['sql'], ...$ret['bindings']);

        return $row['cnt'];
    }

    /** １行だけ取得 */
    public function one()
    {
        $this->limit(1);
        $ret = $this->build();

        return $this->db()->one($ret['sql'], ...$ret['bindings']);
    }

    /** 全件取得 */
    public function all()
    {
        $ret = $this->build();

        return $this->db()->all($ret['sql'], ...$ret['bindings']);
    }

    /** DBインスタンス */
    private function db()
    {
        return App::get('db');
    }

    /** カラムのビルド */
    private function buildColumns()
    {
        return $this->buildCommon($this->columns, ', ');
    }

    /** WHERE文のビルド */
    private function buildWhere()
    {
        return $this->buildCommon($this->wheres, ' AND ');
    }

    /** HAVING文のビルド */
    private function buildHaving()
    {
        return $this->buildCommon($this->havings, ' AND ');
    }

    /** 共通のビルド */
    private function buildCommon(array $conf, string $connector)
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
