<?php

declare(strict_types=1);

namespace SFW\Data;

/**
 * パス関連
 */
class Path
{
    /** PHPファイルだけ取得 */
    public static function scanPhpFiles(string $path): array
    {
        $phpFiles = array_filter(scandir($path), fn($f) => str_ends_with($f, '.php'));

        return $phpFiles;
    }

    /**
     * 対象のディレクトリの全ファイル・全ディレクトリを再帰的に列挙するiteratorを作成
     */
    public static function getRecursiveIterator(string $targetDir): \RecursiveIteratorIterator
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($targetDir, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        return $iterator;
    }
}
