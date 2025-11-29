<?php

namespace App\Controllers;

use SFW\Routing\Controller as BaseController;
use SFW\Output\Log;
use SFW\Core\Config;
use SFW\Core\App;
use SFW\Routing\Location;

use App\Models\User;

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

        // beforeActionでの、リダイレクト処理のサンプル
        if ((App::get('router')->currentRoute['options']['name'] ?? null) === 'redirect_test') {
            Log::info('redirect_test');

            Location::redirect('/');

            Log::info('このログは出力されない。');
        }

        // ログインユーザー取得
        if (isset($_SESSION["user_id"])) {
            $user = User::queryIncludeId($_SESSION["user_id"])
                ->scope([User::class, 'kept'])
                ->one();

            if ($user) {
                App::getContainer()->setSingleton('user', $user);
            }
        }

        // 認証処理
        if ((App::get('router')->currentRoute['options']['auth'] ?? null) === 'user') {
            if (! App::get('user')) {
                Location::redirect('/');
            }
        }
    }
}
