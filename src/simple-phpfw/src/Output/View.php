<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Core\Config;

/**
 * View管理
 */
class View
{
    /** テンプレートファイルのポストフィックス */
    private const FILE_POSTFIX = '.html.php';

    /** レイアウトに渡すデータのキー */
    public const KEY_LAYOUT_OPTIONS = '___SFW_LAYOUT_OPTIONS';

    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** 共通変数 */
    private array $data = [];

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $baseDir = $this->baseDir ?? SFW_PROJECT_ROOT . '/resources/views';
        $path = $baseDir . '/' . str_replace('.', '/', $name) . self::FILE_POSTFIX;

        if (!file_exists($path)) {
            throw new \Exception("View not found: $name. path: $path.");
        }

        $meta = [
            'name' => $name,
            'baseDir' => $baseDir,
            'path' => $path,
        ];

        return $this->includeTemplate($meta, $data);
    }

    /**
     * アウトバッファーを使い、テンプレート読み込み
     */
    private function includeTemplate(array $meta, array $data): string
    {
        // $dataはインクルード先で利用している

        ob_start();
        try {
            include $meta['path'];
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
    public function setBaseDir(string $baseDir): void
    {
        $this->baseDir = $baseDir;
    }

    /**
     * 共通変数追加
     */
    public function appendCommonData(array $data): void
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
    ): string {
        $this->appendCommonData($globalData);

        // レイアウトに渡す値
        //（オブジェクトにすることで参照渡しになるので、$nameのテンプレートからレイアウトに値を渡せる）
        $layoutOptions = new \stdClass;

        $data[self::KEY_LAYOUT_OPTIONS] = $layoutOptions;

        $val = $this->render($name, $data);

        if ($layout) {
            // レイアウトの指定があるとき

            $val = $this->render($layout, [
                'content' => $val,
                self::KEY_LAYOUT_OPTIONS => $data[self::KEY_LAYOUT_OPTIONS],
            ] + $layoutData);
        }

        return $val;
    }

    /** フレームワークで使うview */
    public static function fwView(): self
    {
        $view = new self();

        $view->setBaseDir(dirname(dirname(__DIR__)) . '/views');

        return $view;
    }

    /** エラー画面で使うview */
    public static function errorView(): self
    {
        $view = Config::get('debug') ? self::fwView() : new self();

        return $view;
    }
}
