<?php

namespace SFW\Core;

use SFW\Data\Arr;

/**
 * 設定ファイル管理
 */
class Config
{
    /** 設定取得 */
    public static function get($key): mixed
    {
        $config = App::get('config');

        return Arr::dotValue($config, $key);
    }
}
