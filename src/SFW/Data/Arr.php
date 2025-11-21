<?php

namespace SFW\Data;

/**
 * 配列関連
 */
class Arr
{
    /**
     * ドット記法で配列取得
     */
    public static function dotValue(array $array, string $key, $default = null)
    {
        if ($key === null) return $array;

        $keys = explode('.', $key);

        foreach ($keys as $k) {
            if (!is_array($array) || !array_key_exists($k, $array)) {
                return $default;
            }
            $array = $array[$k];
        }

        return $array;
    }
}
