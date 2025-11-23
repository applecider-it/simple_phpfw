<?php

namespace SFW\Core;

use SFW\Data\Arr;
use SFW\Data\Str;
use SFW\Data\Path;

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
        if ($val === null) $val = $key;
        return Str::template($val, $data);
    }

    /** 言語ファイル読み込み */
    public static function includeLang()
    {
        $path = SFW_PROJECT_ROOT . '/resources/lang';

        $phpFiles = Path::scanPhpFiles($path);

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
