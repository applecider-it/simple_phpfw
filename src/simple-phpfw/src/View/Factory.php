<?php

declare(strict_types=1);

namespace SFW\View;

use SFW\Core\Config;

/**
 * Viewの生成管理
 */
class Factory
{
    /** フレームワークで使うview */
    public static function fwView(): View
    {
        $view = new View();

        $view->setBaseDir(dirname(dirname(__DIR__)) . '/views');

        return $view;
    }

    /** エラー画面で使うview */
    public static function errorView(): View
    {
        $view = Config::get('debug') ? self::fwView() : new View();

        return $view;
    }
}
