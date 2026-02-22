<?php

declare(strict_types=1);

namespace SFW\Core;

/**
 * グローバルアクセス管理
 */
class App
{
    private static Container $container;

    /** コンテナ設定 */
    public static function setContainer(Container $container): void
    {
        self::$container = $container;
    }

    /** コンテナ取得 */
    public static function getContainer(): Container
    {
        return self::$container;
    }

    /** シングルトン取得ショートカット */
    public static function get(string $key): mixed
    {
        return self::$container->getSingleton($key)['value'];
    }
}
