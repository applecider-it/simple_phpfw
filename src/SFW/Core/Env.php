<?php
namespace SFW\Core;

/**
 * 環境変数管理
 */
class Env
{
    /** .envをロード */
    public static function load(string $path)
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
            $data[trim($name)] = trim($value);
        }

        return $data;
    }
}
