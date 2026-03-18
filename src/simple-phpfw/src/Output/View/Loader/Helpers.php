<?php

declare(strict_types=1);

namespace SFW\Output\View\Loader;

use SFW\Output\Html;
use SFW\Core\App;

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

    /** ルート取得 */
    function route(string $name, array $data = []): string
    {
        /** @var \SFW\Web\Router */
        $router = App::get('router');
        return $router->route($name, $data);
    }
}
