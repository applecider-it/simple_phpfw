<?php

declare(strict_types=1);

namespace SFW\View;

/**
 * Viewのレイアウト管理
 */
class Layout
{
    /** レイアウトに渡すデータのキー */
    public const KEY_LAYOUT_OPTIONS = '___SFW_LAYOUT_OPTIONS';

    /** レイアウトコンテンツのキー */
    public const KEY_LAYOUT_CONTENT = '___SFW_LAYOUT_CONTENT';

    /**
     * レイアウト付きで描画して文字列を返す
     */
    public static function renderWithLayout(
        View $view,
        string $name,
        array $data = [],
        ?string $layout = null,
        array $layoutData = [],
        array $globalData = []
    ): string {
        $globalData[self::KEY_LAYOUT_OPTIONS] = [];

        $view->appendCommonData($globalData);

        $val = $view->render($name, $data);

        if ($layout) {
            // レイアウトの指定があるとき

            $val = $view->render($layout, [
                self::KEY_LAYOUT_CONTENT => $val,
            ] + $layoutData);
        }

        return $val;
    }
}
