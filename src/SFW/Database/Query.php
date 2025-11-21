<?php
namespace SFW\Database;

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

        return [
            'sql' => $sql,
            'bindings' => $bindings,
        ];
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
