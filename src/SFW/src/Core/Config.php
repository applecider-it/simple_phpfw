<?php

namespace SFW\Core;

use SFW\Data\Arr;

/**
 * 設定ファイル管理
 */
class Config
{
    /** 設定取得 */
    public static function get($key)
    {
        $config = App::get('config');

        return Arr::dotValue($config, $key);
    }

    /** 設定ファイルをinclude */
    public static function includeConfig()
    {
        // $envはインクルード先で利用する
        $env = Env::load(SFW_PROJECT_ROOT . '/.env');
        
        return include(SFW_PROJECT_ROOT . '/config/config.php');
    }
}
