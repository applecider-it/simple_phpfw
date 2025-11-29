<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller as BaseController;

/**
 * 管理画面のベースコントローラー
 */
abstract class Controller extends BaseController
{
    /** アクション前処理 */
    public function beforeAction()
    {
        parent::beforeAction();
    }
}
