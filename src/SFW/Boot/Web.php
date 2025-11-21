<?php

namespace SFW\Boot;

use SFW\Core\App;

/**
 * Webのブート時の処理
 */
class Web
{
    public function dispatch()
    {
        $router = App::get('router');

        echo $router->dispatch();
    }
}
