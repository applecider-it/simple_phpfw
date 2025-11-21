<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Core\Container;
use SFW\Core\Env;
use SFW\Routing\Router;
use SFW\Database\DB;

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

        $this->includeEnv();
        $this->setupService();
        $this->includeRoutes();
        $this->initDatabase();
    }

    /** .env読み込み */
    private function includeEnv()
    {
        $env = Env::load(SFW_PROJECT_ROOT . '/.env');
        App::getContainer()->setSingleton('env', $env);
    }

    /** サービス設定 */
    private function setupService()
    {
        App::getContainer()->setSingleton('router', new Router());
        App::getContainer()->setSingleton('config', $this->includeConfig());
    }

    /** 設定ファイル読み込み */
    private function includeConfig()
    {
        return include(SFW_PROJECT_ROOT . '/config/config.php');
    }

    /** ルート読み込み */
    private function includeRoutes()
    {
        // include先で、$routerが使われている
        $router = App::get('router');

        include(SFW_PROJECT_ROOT . '/config/routes.php');
    }

    private function initDatabase()
    {
        $config = App::get('config');

        $db = new DB($config['database']);
        App::getContainer()->setSingleton('db', $db);
    }
}
