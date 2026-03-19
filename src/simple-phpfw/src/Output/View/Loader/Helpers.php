<?php

declare(strict_types=1);

namespace SFW\Output\View\Loader;

use SFW\Output\Html;
use SFW\Core\App;
use SFW\Core\Config;

/**
 * ヘルパー関数
 */
trait Helpers
{
    /**
     * 描画して文字列を返す
     */
    private function render(string $name, array $data = []): string
    {
        return $this->view->render($name, $data);
    }

    /** HTMLエスケープ */
    private function h(mixed $val): string
    {
        return Html::esc($val);
    }

    /** ファイル読み込みの際のキャッシュ対応 */
    private function file(string $uri): string
    {
        return Html::file($uri);
    }

    /** ルート取得 */
    private function route(string $name, array $data = []): string
    {
        /** @var \SFW\Web\Router */
        $router = App::get('router');
        return $router->route($name, $data);
    }

    /** シングルトン取得 */
    private function app(string $key): mixed
    {
        return App::get($key);
    }

    /** 設定取得 */
    private function config(string $key): mixed
    {
        return Config::get($key);
    }
}
