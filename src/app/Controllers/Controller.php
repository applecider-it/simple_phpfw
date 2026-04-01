<?php

namespace App\Controllers;

use SFW\Web\Controller as BaseController;

use SFW\Core\App;
use SFW\Output\Log;
use SFW\View\View;
use SFW\View\Layout;

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

        return Layout::renderWithLayout(
            $view,
            $name,
            $data,
            $layout,
            $layoutData,
            $globalData
        );
    }
}
