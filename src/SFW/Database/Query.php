<?php
namespace SFW\Database;

/**
 * クエリービルダー
 */
class Query
{
    private string $table;
    private array $wheres = [];

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
