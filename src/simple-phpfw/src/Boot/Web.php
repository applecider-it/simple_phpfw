<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Output\Error;
use SFW\Output\Log;
use SFW\Exceptions;

/**
 * Webのブート時の処理
 */
class Web
{
    /** 実行 */
    public function dispatch(): void
    {
        /** @var \SFW\Web\Router */
        $router = App::get('router');

        try {
            $val = $router->dispatch();

            App::get('callback')->afterRouter($val);
        } catch (Exceptions\NotFound $e) {
            // ページが見つからないとき

            Error::error404($e);
        } catch (Exceptions\Interruption $e) {
            // 中断時
        } catch (\Throwable $e) {
            // そのほかのエラーの時

            Log::error((string) $e);
            Error::error500($e);
        }
    }
}
