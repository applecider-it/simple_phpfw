<?php

namespace App\Controllers;

use SFW\Web\Controller as BaseController;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Output\View;
use SFW\Web\Location;
use SFW\Web\Session;
use SFW\Web\Flash;

use App\Models\User;

/**
 * アプリケーションベースコントローラー
 */
abstract class Controller extends BaseController
{
    /** アクション前処理 */
    public function beforeAction()
    {
        // beforeActionでの、リダイレクト処理のサンプル
        if ((App::get('router')->currentRoute['options']['name'] ?? null) === 'redirect_test') {
            Log::info('redirect_test');

            Location::redirect('/');

            Log::info('このログは出力されない。');
        }

        // ログインユーザー取得
        $userId = Session::get(User::AUTH_SESSION_KEY);
        if ($userId) {
            $user = User::find($userId);

            if ($user) {
                User::hidden($user);
                App::getContainer()->setSingleton('user', $user);
            }
        }

        // 認証処理
        if ((App::get('router')->currentRoute['options']['auth'] ?? null) === 'user') {
            if (! App::get('user')) {
                Flash::set('alert', Lang::get('errors.loginRequired'));
                Location::redirect('/login');
            }
        }
    }

    /** HTML描画結果を返す */
    protected function render(
        string $name,
        array $data = [],
        string $layout = 'layouts.app',
        array $layoutData = [],
        array $globalData = []
    ) {
        $view = new View();

        $view->appendData($globalData);

        return $view->render($layout, [
            'content' => $view->render($name, $data),
        ], $layoutData);
    }
}
