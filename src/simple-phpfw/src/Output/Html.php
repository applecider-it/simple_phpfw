<?php

namespace SFW\Output;

use SFW\Core\Config;

/**
 * HTML関連
 */
class Html
{
    /** エスケープ */
    public static function esc(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

    /** ファイル読み込みの際のキャッシュ対応 */
    public static function file(string $url): string
    {
        $filePostfix = Config::get('filePostfix');

        return $url . '?' . $filePostfix;
    }
}
