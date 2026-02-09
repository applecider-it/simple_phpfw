<?php

namespace SFW\Data;

/**
 * ファイル関連
 */
class File
{
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
