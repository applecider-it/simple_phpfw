<?php

namespace App\Services\Core;

/**
 * システム管理
 */
class System
{
    /**
     * 設定読み込み
     */
    public static function loadConfig()
    {
        return include(dirname(dirname(__DIR__)) . '/config/config.php');
    }
}
