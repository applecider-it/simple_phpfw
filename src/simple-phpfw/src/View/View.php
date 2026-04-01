<?php

declare(strict_types=1);

namespace SFW\View;

/**
 * View管理
 */
class View
{
    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** 読み込み管理 */
    private Loader $loader;

    function __construct()
    {
        $this->loader = new Loader($this);
    }

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $meta = $this->getMeta($name);

        return $this->loader->includeTemplate($meta, $data);
    }

    /**
     * 描画情報を返す
     */
    private function getMeta(string $name): array
    {
        $baseDir = $this->baseDir ?? SFW_PROJECT_ROOT . '/resources/views';

        $path = $baseDir . '/' . str_replace('.', '/', $name) . '.html.php';
        if (!file_exists($path)) {
            throw new \Exception("View not found: $name.");
        }

        return compact('name', 'baseDir', 'path');
    }

    /**
     * 基準となるディレクトリパスを設定
     */
    public function setBaseDir(string $baseDir): void
    {
        $this->baseDir = $baseDir;
    }

    /**
     * 共通変数追加
     */
    public function appendCommonData(array $data): void
    {
        $this->loader->data = $data + $this->loader->data;
    }
}
