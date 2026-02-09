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
    public static function get($key, array $templateData = []): string
    {
        $lang = App::get('lang');
        $val = Arr::dotValue($lang, Config::get('lang') . '.' . $key);
        if ($val === null) $val = $key;
        return Str::template($val, $templateData);
    }
}
