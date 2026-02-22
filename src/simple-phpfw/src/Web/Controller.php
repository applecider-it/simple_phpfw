<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * ベースコントローラー
 */
abstract class Controller
{
    /** URIの値、GET、POST、JSONデータの順番で優先的に保管される */
    public array $params = [];

    /** アクション前処理 */
    public function beforeAction() {}
}
