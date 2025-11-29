<?php

namespace App\Controllers;

use SFW\Routing\Controller as BaseController;
use SFW\Output\Log;
use SFW\Core\Config;
use SFW\Core\App;
use SFW\Routing\Location;

/**
 * アプリケーションベースコントローラー
 */
abstract class Controller extends BaseController
{
    /** アクション前処理 */
    public function beforeAction()
    {
        // トレース
        if (Config::get('debug')) {
            Log::info('Controller: route: ', App::get('router')->currentRoute);
            Log::info('Controller: params: ', $this->params);
        }

        // リダイレクト処理のサンプル
        if ((App::get('router')->currentRoute['options']['name'] ?? null) === 'redirect_test') {
            Log::info('redirect_test');

            Location::redirect('/');

            Log::info('このログは出力されない。');
        }

        // 認証処理
        if ((App::get('router')->currentRoute['options']['auth'] ?? null) === 'user') {
            if (! isset($_SESSION["user_id"])) {
                Location::redirect('/');
            }
        }
    }
}
