<?php

namespace SFW\Boot;

use SFW\Core\App;
use SFW\Output\Error;

/**
 * Webのブート時の処理
 */
class Web
{
    /** 実行 */
    public function dispatch()
    {
        /** @var \SFW\Routing\Router */
        $router = App::get('router');

        try {
            echo $router->dispatch();
        }
        catch (\SFW\Exceptions\NotFound $e) {
            Error::error404($e);
        }
        catch (\Throwable $e) {
            Error::error500($e);
        }
    }
}
