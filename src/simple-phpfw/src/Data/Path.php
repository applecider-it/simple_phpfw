<?php

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
}
