<?php

namespace SFW\Database;

use PDO;
use PDOException;

use SFW\Core\App;

/**
 * データベース管理
 */
class DB
{
    private PDO $pdo;

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
    public function one(string $sql, ...$bindings): array|false
    {
        $stmt = $this->exec($sql, $bindings);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** 全件取得 */
    public function all(string $sql, ...$bindings): array
    {
        $stmt = $this->exec($sql, $bindings);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 追加 */
    public function insert(string $table, array $data): int
    {
        $sqlData = $this->dataToSqlData($data);
        $columns = implode(', ', $sqlData['columnsForInsert']);
        $placeholders = implode(',', $sqlData['placeholdersForInsert']);
        $sql = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";

        $this->exec($sql, $sqlData['bindings']);

        return $this->pdo->lastInsertId();
    }

    /** 更新 */
    public function update(string $table, array $data, string $whereSql, ...$whereBindings): int
    {
        $sqlData = $this->dataToSqlData($data);
        $set = implode(', ', $sqlData['columnsForUpdate']);
        $sql = "UPDATE {$table} SET $set";
        $sql .= " WHERE {$whereSql}";

        $stmt = $this->exec($sql, array_merge($sqlData['bindings'], $whereBindings));

        return $stmt->rowCount();
    }

    /** 登録更新データをSQL用データに変換 */
    private function dataToSqlData(array $data): array
    {
        $columnsForInsert = [];
        $columnsForUpdate = [];
        $placeholdersForInsert = [];
        $bindings = [];
        foreach ($data as $column => $val) {
            $columnsForInsert[] = $column;
            if ($val instanceof Raw) {
                // Rawオブジェクトの時は、プレースホルダーを使わない
                // これは、NOW()などを指定するときに使う
                $columnsForUpdate[] = "$column = {$val->value}";
                $placeholdersForInsert[] = $val->value;
            } else {
                $columnsForUpdate[] = "$column = ?";
                $placeholdersForInsert[] = "?";
                $bindings[] = $val;
            }
        }
        return [
            'columnsForInsert' => $columnsForInsert,
            'columnsForUpdate' => $columnsForUpdate,
            'placeholdersForInsert' => $placeholdersForInsert,
            'bindings' => $bindings,
        ];
    }

    /** 削除 */
    public function delete($table, string $whereSql, ...$whereBindings): int
    {
        $sql = "DELETE FROM {$table}";
        $sql .= " WHERE {$whereSql}";

        $stmt = $this->exec($sql, $whereBindings);

        return $stmt->rowCount();
    }

    /** トランザクション開始 */
    public function startTransaction()
    {
        $this->exec("START TRANSACTION", []);
    }

    /** トランザクションコミット */
    public function commitTransaction()
    {
        $this->exec("COMMIT", []);
    }

    /** トランザクションロールバック */
    public function rollbackTransaction()
    {
        $this->exec("ROLLBACK", []);
    }

    /** 実行の共通処理 */
    private function exec(string $sql, array $bindings)
    {
        $meta = [
            'executionTime' => null,
            'valid' => false,
        ];

        $startTime = microtime(true);

        $stmt = null;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bindings);
        } catch (\Throwable $e) {
            App::get('callback')->afterQuery($sql, $bindings, $meta);
            throw $e;
        }

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        $meta['executionTime'] = $executionTime;
        $meta['valid'] = true;

        App::get('callback')->afterQuery($sql, $bindings, $meta);

        return $stmt;
    }
}
