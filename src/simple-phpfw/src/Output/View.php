<?php

declare(strict_types=1);

namespace SFW\Output;

/**
 * View管理
 */
class View
{
    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** テンプレート管理 */
    private View\Template $template;

    /** テンプレート管理 */
    private View\Loader $loader;

    function __construct()
    {
        $this->template = new View\Template($this);
        $this->loader = new View\Loader($this);
    }

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $meta = $this->template->renderInfo($name);

        return $this->includeTemplate($meta, $data);
    }

    /**
     * アウトバッファーを使い、テンプレート読み込み
     */
    private function includeTemplate(array $meta, array $data): string
    {
        return $this->loader->includeTemplate($meta, $data);
    }

    /**
     * 基準となるディレクトリパスを設定
     */
    public function setBaseDir(string $baseDir): void
    {
        $this->baseDir = $baseDir;
    }

    /**
     * 基準となるディレクトリパス
     */
    public function baseDir(): ?string
    {
        return $this->baseDir;
    }

    /**
     * 共通変数追加
     */
    public function appendCommonData(array $data): void
    {
        $this->loader->data = $data + $this->loader->data;
    }
}
