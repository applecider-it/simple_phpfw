<?php

namespace App\Controllers;

use SFW\Web\Controller as BaseController;

use SFW\Core\App;
use SFW\Output\Log;
use SFW\Output\View;
use SFW\Web\Location;

use function SFW\Helpers\route;

use App\Services\User\AuthService;

/**
 * アプリケーションベースコントローラー
 */
abstract class Controller extends BaseController
{
    protected string $layout = 'layouts.app';

    /** アクション前処理 */
    public function beforeAction()
    {
        $authService = new AuthService();

        $currentRoute = App::get('router')->currentRoute();

        // beforeActionでの、リダイレクト処理のサンプル
        if (($currentRoute['options']['name'] ?? null) === 'development.redirect_test') {
            Log::info('redirect_test');

            Location::redirect(route('index'));

            Log::info('このログは出力されない。');
        }

        $authService->execAuth($currentRoute);
    }

    /**
     * レイアウト付きで描画して文字列を返す
     */
    protected function render(
        string $name,
        array $data = [],
        ?string $layout = 'controller-layout',
        array $layoutData = [],
        array $globalData = []
    ) {
        $view = new View();

        if ($layout === 'controller-layout') $layout = $this->layout;

        return View\Layout::renderWithLayout(
            $view,
            $name,
            $data,
            $layout,
            $layoutData,
            $globalData
        );
    }
}
