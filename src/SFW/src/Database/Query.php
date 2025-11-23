<?php

namespace SFW\Database;

use SFW\Core\App;

/**
 * クエリービルダー
 */
class Query
{
    /** テーブル名 */
    private string $table;

    /** WHERE文用データ配列 */
    private array $wheres = [];

    /** ORDER文用データ配列 */
    private array $orders = [];

    /** 上限 */
    private int|null $limit = null;

    /** テーブル指定 */
    public function table(string $table): self
    {
        $this->table = $table;
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

    /** order追加 */
    public function order(string $sql): self
    {
        $this->orders[] = $sql;
        return $this;
    }

    /** 上限指定 */
    public function limit(int|null $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /** SQLと値をビルドする */
    public function build()
    {
        $sql = "SELECT * FROM {$this->table}";
        $bindings = [];

        if ($this->wheres) {
            $ret = $this->buildWhere();
            $sql .= " WHERE " . $ret['sql'];
            $bindings = array_merge($bindings, $ret['bindings']);
        }

        if ($this->orders) {
            $sql .= " ORDER BY " . implode(", ", $this->orders);
        }

        if ($this->limit) $sql .= " LIMIT {$this->limit}";

        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
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

    /** WHERE文のビルド */
    private function buildWhere()
    {
        $sqls = [];
        $bindings = [];

        foreach ($this->wheres as $where) {
            $sqls[] = $where['sql'];
            $bindings = array_merge($bindings, $where['bindings']);
        }

        $sql = implode(' AND ', $sqls);

        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
    }
}
