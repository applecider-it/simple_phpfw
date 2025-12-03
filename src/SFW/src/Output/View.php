<?php

namespace SFW\Output;

use SFW\Core\Config;

/**
 * View管理
 */
class View
{
    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    public ?string $baseDir = null;

    /** 共通変数 */
    public array $data = [];

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = [])
    {
        // $dataはインクルード先で利用している

        $baseDir = $this->baseDir ?? SFW_PROJECT_ROOT . '/resources/views';
        $path = $baseDir . '/' . str_replace('.', '/', $name) . '.html.php';

        if (!file_exists($path)) {
            throw new \Exception("View not found: $name. path: $path.");
        }

        ob_start();
        include $path;
        return ob_get_clean();
    }

    /** フレームワークで使うview */
    public static function fwView() {
        $view = new self();

        $view->baseDir = dirname(dirname(__DIR__)) . '/views';

        return $view;
    }

    /** エラー画面で使うview */
    public static function errorView() {
        $view = Config::get('debug') ? self::fwView() : new self();

        return $view;
    }
}
