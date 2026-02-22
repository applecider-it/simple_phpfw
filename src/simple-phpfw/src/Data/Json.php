<?php

declare(strict_types=1);

namespace SFW\Data;

/**
 * Json関連
 */
class Json
{
    /**
     * オブジェクト以外は、型がわかるprint_rみたいな関数
     */
    public static function trace(mixed $array, bool $return = false): ?string
    {
        $val = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
        if ($return) return $val;

        echo $val;

        return null;
    }
}
