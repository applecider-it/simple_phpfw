<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Core\Container;
use SFW\Core\Env;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Routing\Router;
use SFW\Database\DB;

use App\Core\Callback;

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
        $this->setupDatabase();

        App::get('callback')->afterInit();
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
        App::getContainer()->setSingleton('config', Config::includeConfig());
        App::getContainer()->setSingleton('lang', Lang::includeLang());
        App::getContainer()->setSingleton('callback', new Callback());
    }

    /** ルート読み込み */
    private function includeRoutes()
    {
        // include先で、$routerが使われている
        $router = App::get('router');

        include(SFW_PROJECT_ROOT . '/config/routes.php');
    }

    /** データベースセットアップ */
    private function setupDatabase()
    {
        $db = new DB(Config::get('database'));
        App::getContainer()->setSingleton('db', $db);
    }
}
