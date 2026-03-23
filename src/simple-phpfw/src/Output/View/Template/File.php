<?php

declare(strict_types=1);

namespace SFW\Output\View\Template;

/**
 * テンプレートのファイル関連
 */
class File
{
    /** テンポラリーファイル生成が必要か返す */
    public static function checkGenarate(string $path, string $tmpPath): bool
    {
        if (!file_exists($tmpPath)) {
            // テンポラリーファイルがないとき

            return true;
        }

        if (filemtime($tmpPath) < filemtime($path)) {
            // テンポラリーファイルより、ソースファイルの更新日時が新しいとき

            return true;
        }

        return false;
    }

    /** テンポラリーファイル名 */
    public static function tempFileName(string $path): string
    {
        $name = basename($path);
        $dir = basename(dirname($path));

        $info = pathinfo($name);
        $fileName = $info['filename'];
        $extension  = $info['extension'];

        $tempFileName = $dir . '__' . $fileName . '__' . md5($path) . '.' . $extension;

        return $tempFileName;
    }
}
