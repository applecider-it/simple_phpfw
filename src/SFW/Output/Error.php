<?php

namespace SFW\Output;

/**
 * エラー表示関連
 */
class Error
{
    /** 500エラー表示 */
    public static function error500(\Throwable $e)
    {
        $view = new View();
        echo $view->render('errors.error500', [
            'e' => $e,
        ]);
        http_response_code(500);
    }
}
