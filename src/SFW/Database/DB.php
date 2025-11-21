<?php

namespace SFW\Database;

use PDO;
use PDOException;

/**
 * データベース管理
 */
class DB
{
    protected PDO $pdo;
    public $tracable = false;

    public function __construct(array $config)
    {
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    /** １行だけ取得 */
    public function one(string $sql, ...$bindings)
    {
        $stmt = $this->exec($sql, $bindings);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** 全件取得 */
    public function get(string $sql, ...$bindings)
    {
        $stmt = $this->exec($sql, $bindings);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 追加 */
    public function insert(string $table, array $data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";

        $this->exec($sql, array_values($data));

        return $this->pdo->lastInsertId();
    }

    /** 更新 */
    public function update(string $table, array $data, string $whereSql, ...$whereBindings)
    {
        $set = implode(',', array_map(fn($col) => "$col = ?", array_keys($data)));
        $sql = "UPDATE {$table} SET $set";
        $sql .= " WHERE {$whereSql}";

        $stmt = $this->exec($sql, array_merge(array_values($data), $whereBindings));

        return $stmt->rowCount();
    }

    /** 削除 */
    public function delete($table, string $whereSql, ...$whereBindings)
    {
        $sql = "DELETE FROM {$table}";
        $sql .= " WHERE {$whereSql}";

        $stmt = $this->exec($sql, $whereBindings);

        return $stmt->rowCount();
    }

    /** 実行の共通処理 */
    private function exec(string $sql, array $bindings)
    {
        $this->trace($sql, $bindings);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bindings);
        return $stmt;
    }

    /** トレース */
    private function trace(string $sql, array $bindings)
    {
        if (! $this->tracable) return;

        echo "<hr />\n";
        echo "<div>SQL:</div>\n";
        echo "<div>\n";
        var_dump([$sql, $bindings]);
        echo "</div>\n";
        echo "<hr />\n";
    }
}
