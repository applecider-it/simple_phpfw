<?php

declare(strict_types=1);

namespace SFW\Core;

/**
 * 環境変数管理
 */
class Env
{
    /**
     * .envをロード
     * 
     * 先頭に#がある行はコメント扱い。
     * 環境変数を優先。
     */
    public static function load(string $path): array
    {
        if (!file_exists($path)) {
            throw new \Exception(".env file not found at $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $data = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;

            [$name, $value] = explode('=', $line, 2);
            $key = trim($name);

            // 環境変数を優先する
            $data[$key] = (getenv($key)) ? getenv($key) : self::strToValue($value);
        }

        return $data;
    }

    /**
     * 文字列を変数に変換
     * 
     * true, falseはboolに変換される。
     */
    private static function strToValue(string $value): mixed
    {
        $value = trim($value);

        return match ($value) {
            'true' => true,
            'false' => false,
            default => $value,
        };
    }
}
