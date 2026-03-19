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
    /** HTMLエスケープ */
    function h(mixed $val): string
    {
        return Html::esc($val);
    }

    /** ファイル読み込みの際のキャッシュ対応 */
    public static function file(string $uri): string
    {
        return Html::file($uri);
    }

    /** ルート取得 */
    function route(string $name, array $data = []): string
    {
        /** @var \SFW\Web\Router */
        $router = App::get('router');
        return $router->route($name, $data);
    }

    /** シングルトン取得 */
    public static function app(string $key): mixed
    {
        return App::get($key);
    }

    /** 設定取得 */
    public static function config($key): mixed
    {
        return Config::get($key);
    }
}
