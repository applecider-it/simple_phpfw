<?php

namespace SFW\Core;

use SFW\Data\Arr;
use SFW\Data\Str;

/**
 * 言語ファイル管理
 */
class Lang
{
    /** 言語取得 */
    public static function get($key, array $data = [])
    {
        $lang = App::get('lang');
        $val = Arr::dotValue($lang, Config::get('lang') . '.' . $key);
        return Str::template($val, $data);
    }

    /** 言語ファイル読み込み */
    public static function includeLang()
    {
        $path = SFW_PROJECT_ROOT . '/resources/lang';

        // PHPファイルだけ取得
        $phpFiles = array_filter(scandir($path), fn($f) => str_ends_with($f, '.php'));

        $lang = [];
        foreach ($phpFiles as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $lang[$name] = self::safeInclude($path . '/' . $file);
        }

        return $lang;
    }

    /** ローカル変数を保護しながらinclude */
    private static function safeInclude($path)
    {
        return include($path);
    }
}
