<?php

namespace App\Controllers;

use SFW\Routing\Controller;
use SFW\Output\Log;

/**
 * アプリケーションベースコントローラー
 */
class ApplicationController extends Controller
{
    /** アクション前処理 */
    public function beforeAction() {
        Log::info('params', $this->params);
    }
}
