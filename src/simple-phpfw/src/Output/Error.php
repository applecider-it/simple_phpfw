<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Web\Response;
use SFW\View\Factory;

/**
 * エラー表示関連
 */
class Error
{
    /** 500エラー表示 */
    public static function error500(\Throwable $e): void
    {
        Response::code(Response::CODE_INTERNAL_SERVER_ERROR);

        $view = Factory::errorView();
        echo $view->render('errors.error500', [
            'e' => $e,
        ]);
    }

    /** 404エラー表示 */
    public static function error404(\Throwable $e): void
    {
        Response::code(Response::CODE_NOT_FOUND);

        $view = Factory::errorView();
        echo $view->render('errors.error404', [
            'e' => $e,
        ]);
    }
}
