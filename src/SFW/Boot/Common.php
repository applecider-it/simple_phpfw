<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Core\Container;
use SFW\Routing\Router;

/**
 * ブート時の共通処理
 */
class Common
{
    /** 初期化 */
    public function init()
    {
        $container = new Container();
        App::setContainer($container);

        $container->setSingleton('router', new Router());
        $container->setSingleton('config', $this->includeConfig());

        $this->includeRoutes();
    }

    /** 設定ファイル読み込み */
    private function includeConfig()
    {
        return include(SFW_PROJECT_ROOT . '/config/config.php');
    }

    /** ルート読み込み */
    private function includeRoutes()
    {
        $router = App::get('router');

        include(SFW_PROJECT_ROOT . '/config/routes.php');
    }
}
