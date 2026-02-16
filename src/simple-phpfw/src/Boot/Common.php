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
    public function init(): void
    {
        $this->loadHelpers();

        $container = new Container();
        App::setContainer($container);

        $this->setupService();
        $this->includeRoutes();
        $this->setupDatabase();
        $this->setupRedis();

        App::get('callback')->afterInit();
    }

    /**
     * ヘルパー読み込み
     * 
     * 関数はオートロードできないので、ここで手動読み込み
     */
    private function loadHelpers(): void
    {
        require_once dirname(__DIR__) . '/Helpers/helpers.php';
    }

    /** サービス設定 */
    private function setupService(): void
    {
        App::getContainer()->setSingleton('router', new Router(), 'Router');
        App::getContainer()->setSingleton('config', $this->includeConfig(), 'Config');
        App::getContainer()->setSingleton('lang', $this->includeLang(), 'Language Data');
        App::getContainer()->setSingleton('callback', new Callback(), 'Callback class');
    }

    /** ルート読み込み */
    private function includeRoutes(): void
    {
        // include先で、$routerが使われている
        $router = App::get('router');

        include(SFW_PROJECT_ROOT . '/routes/web.php');
    }

    /** データベースセットアップ */
    private function setupDatabase(): void
    {
        $db = new DB(Config::get('database'));
        App::getContainer()->setSingleton('db', $db, 'Main database');
    }


    /** Redisセットアップ */
    private function setupRedis(): void
    {
        $redis = new \Redis();
        $redis->connect(Config::get('redis.host'), Config::get('redis.port'));
        App::getContainer()->setSingleton('redis', $redis, 'Main redis');
    }

    /** 設定ファイルをinclude */
    private function includeConfig(): array
    {
        // $envはインクルード先で利用する
        $env = Env::load(SFW_PROJECT_ROOT . '/.env');

        return include(SFW_PROJECT_ROOT . '/config/config.php');
    }

    /** 言語ファイル読み込み */
    private function includeLang(): array
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
    private function safeInclude($path): array
    {
        return include($path);
    }
}
