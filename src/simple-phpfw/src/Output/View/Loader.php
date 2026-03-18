<?php

declare(strict_types=1);

namespace SFW\Output\View;

use SFW\Output\View;

/**
 * 読み込み管理
 */
class Loader
{
    use Loader\Helpers;

    /** View管理 */
    private View $view;

    /** 共通変数 */
    public array $data = [];

    function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * 描画して文字列を返す（テンプレート内からの利用のみ）
     */
    public function render(string $name, array $data = []): string
    {
        return $this->view->render($name, $data);
    }

    /**
     * アウトバッファーを使い、テンプレート読み込み
     */
    public function includeTemplate(array $meta, array $data): string
    {
        // 変数を退避
        $___sfw__view__keep = [
            'meta' => $meta,
            'data' => $data,
        ];

        // 変数を展開
        extract($data);

        // 戻す
        // $data, $meta変数は上書きされるので注意！
        $data = $___sfw__view__keep['data'];
        $meta = $___sfw__view__keep['meta'];

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
}
