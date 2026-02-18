<?php

namespace SFW\Output;

use SFW\Core\Config;

/**
 * View管理
 */
class View
{
    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** 共通変数 */
    private array $data = [];

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
        try {
            include $path;
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
        $val = ob_get_clean();

        return $val;
    }

    /**
     * 基準となるディレクトリパスを設定
     */
    public function setBaseDir(string $baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * データ追加
     */
    public function appendData(array $data)
    {
        $this->data = $data + $this->data;
    }

    /**
     * レイアウト付きで描画して文字列を返す
     */
    public function renderWithLayout(
        string $name,
        array $data = [],
        ?string $layout = null,
        array $layoutData = [],
        array $globalData = []
    ) {
        $this->appendData($globalData);

        $val = $this->render($name, $data);

        if ($layout) {
            $val = $this->render($layout, [
                'content' => $val,
            ] + $layoutData);
        }

        return $val;
    }

    /** フレームワークで使うview */
    public static function fwView()
    {
        $view = new self();

        $view->setBaseDir(dirname(dirname(__DIR__)) . '/views');

        return $view;
    }

    /** エラー画面で使うview */
    public static function errorView()
    {
        $view = Config::get('debug') ? self::fwView() : new self();

        return $view;
    }
}
