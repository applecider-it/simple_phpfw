<?php

declare(strict_types=1);

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

    /**
     * @param string $database データベースシングルトン名
     */
    public function __construct(private string $database = 'db') {}

    /** テーブル指定 */
    public function table(string $sql, ...$value): self
    {
        $this->tables[] = [
            'sql' => $sql,
            'bindings' => $value,
        ];
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

    /** Where削除 */
    public function removeWhere(string $sql, ...$value): self
    {
        $target = [
            'sql' => $sql,
            'bindings' => $value,
        ];

        $this->removeParts($this->wheres, $target);

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
    public function build(bool $buildForCount = false): array
    {
        $builder = new Query\Builder($this);
        return $builder->build($buildForCount);
    }

    /** カウントする */
    public function count(): int
    {
        $ret = $this->build(true);

        $row = $this->db()->one($ret['sql'], ...$ret['bindings']);

        return (int) $row[Query\Builder::WORK_COUNT_COLUMN];
    }

    /** １行だけ取得 */
    public function one(): array|false
    {
        $limit = $this->limit;
        $this->limit = 1;
        $ret = $this->build();
        $this->limit = $limit;

        return $this->db()->one($ret['sql'], ...$ret['bindings']);
    }

    /** 全件取得 */
    public function all(): array
    {
        $ret = $this->build();

        return $this->db()->all($ret['sql'], ...$ret['bindings']);
    }

    /** DBインスタンス */
    private function db(): DB
    {
        return App::get($this->database);
    }

    /** 部品削除 */
    private function removeParts(&$parts, $target): void
    {
        $parts = array_values(
            array_filter(
                $parts,
                fn ($value) => $value !== $target
            )
        );
    }

    /** 全ての情報を返す */
    public function getAllDatta() : array {
        return [
            'tables' => $this->tables,
            'distinct' => $this->distinct,
            'columns' => $this->columns,
            'wheres' => $this->wheres,
            'havings' => $this->havings,
            'orders' => $this->orders,
            'groups' => $this->groups,
            'limit' => $this->limit,
            'offset' => $this->offset,
            'database' => $this->database,
        ];
    }
}
