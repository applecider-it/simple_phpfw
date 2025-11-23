<?php

namespace SFW\Output;

/**
 * View管理
 */
class View
{
    /** 共通変数 */
    public array $data = [];

    /**
     * 描画して文字列を返す
     */
    public function render(string $view, array $data = [])
    {
        // $dataはインクルード先で利用している

        $path = SFW_PROJECT_ROOT . '/resources/views/' . str_replace('.', '/', $view) . '.html.php';

        if (!file_exists($path)) {
            throw new \Exception("View not found: $view. path: $path.");
        }

        ob_start();
        include $path;
        return ob_get_clean();
    }
}
