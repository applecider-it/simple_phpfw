<?php

namespace SFW\Core;

/**
 * グローバルアクセス管理
 */
class App
{
    private static Container $container;

    /** コンテナ設定 */
    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

    /** コンテナ取得 */
    public static function getContainer()
    {
        return self::$container;
    }

    /** シングルトン取得ショートカット */
    public static function get(string $key)
    {
        return self::$container->getSingleton($key);
    }
}
