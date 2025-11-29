<?php

namespace SFW\Data;

/**
 * Json関連
 */
class Json
{
    /**
     * 型がわかるprint_rみたいな関数
     */
    public static function trace(array $array)
    {
        echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
    }
}
