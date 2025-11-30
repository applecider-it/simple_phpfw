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
    public function dispatch()
    {
        /** @var \SFW\Web\Router */
        $router = App::get('router');

        try {
            echo $router->dispatch();
        }
        catch (Exceptions\NotFound $e) {
            Error::error404($e);
        }
        catch (Exceptions\Interruption $e) {
        }
        catch (\Throwable $e) {
            Log::error((string) $e);
            Error::error500($e);
        }
    }
}
