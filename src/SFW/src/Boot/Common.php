<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Core\Container;
use SFW\Core\Env;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Web\Router;
use SFW\Database\DB;
use SFW\Data\Path;

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

        $this->setupService();
        $this->includeRoutes();
        $this->setupDatabase();

        App::get('callback')->afterInit();
    }

    /** サービス設定 */
    private function setupService()
    {
        App::getContainer()->setSingleton('router', new Router());
        App::getContainer()->setSingleton('config', $this->includeConfig());
        App::getContainer()->setSingleton('lang', $this->includeLang());
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

    /** 設定ファイルをinclude */
    private function includeConfig()
    {
        // $envはインクルード先で利用する
        $env = Env::load(SFW_PROJECT_ROOT . '/.env');
        
        return include(SFW_PROJECT_ROOT . '/config/config.php');
    }

    /** 言語ファイル読み込み */
    private function includeLang()
    {
        $path = SFW_PROJECT_ROOT . '/resources/lang';

        $phpFiles = Path::scanPhpFiles($path);

        $lang = [];
        foreach ($phpFiles as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $lang[$name] = $this->safeInclude($path . '/' . $file);
        }

        return $lang;
    }

    /** ローカル変数を保護しながらinclude */
    private function safeInclude($path)
    {
        return include($path);
    }
}
