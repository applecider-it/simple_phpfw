<?php

namespace SFW\Core;

/**
 * グローバルアクセス管理
 */
class App
{
    private static Container $container;

    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

    public static function get(string $key)
    {
        return self::$container->getSingleton($key);
    }
}
