<?php

namespace App\Controllers;

use SFW\Routing\Controller;
use SFW\Output\Log;
use SFW\Core\Config;
use SFW\Core\App;
use SFW\Routing\Location;

/**
 * アプリケーションベースコントローラー
 */
abstract class ApplicationController extends Controller
{
    /** アクション前処理 */
    public function beforeAction()
    {
        if (Config::get('debug')) {
            Log::info('route', App::get('router')->currentRoute);
            Log::info('params', $this->params);
        }

        if ((App::get('router')->currentRoute['options']['name'] ?? null) === 'redirect_test') {
            Log::info('redirect_test');

            Location::redirect('/');

            Log::info('after redirect');
        }
    }
}
