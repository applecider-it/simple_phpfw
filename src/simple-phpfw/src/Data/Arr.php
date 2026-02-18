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
    public static function dotValue(array $array, string $key, $default = null): mixed
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

    /**
     * 特定のキーだけ取得
     */
    public static function choise(array $array, array $keys): array
    {
        return array_filter(
            $array,
            fn($value, $key) => in_array($key, $keys, true),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * 特定のキーだけ除外
     */
    public static function exclude(array $array, array $keys): array
    {
        return array_filter(
            $array,
            fn($value, $key) => !in_array($key, $keys, true),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * 特定のキーを再帰的に隠す
     */
    public static function mask(array $array, array $keys, string $maskValue = '[Filtered]'): array
    {
        array_walk_recursive($array, function (&$value, $key) use ($keys, $maskValue) {
            if (in_array($key, $keys, true)) $value = $maskValue;
        });

        return $array;
    }
}
