<?php

declare(strict_types=1);

namespace SFW\Output\View;

use SFW\Output\View;
use SFW\Output\View\Template\SfwTemplate;

/**
 * View情報管理
 */
class Info
{
    /** View管理 */
    private View $view;

    /** SFW用テンプレート管理 */
    private SfwTemplate $SfwTemplate;

    /** テンプレートファイルタイプリスト */
    private const FILE_TYPES = [
        'html',
        'sfw.blade',
    ];

    function __construct(View $view)
    {
        $this->view = $view;
        $this->SfwTemplate = new SfwTemplate;
    }

    /**
     * 描画して文字列を返す
     */
    public function renderInfo(string $name): array
    {
        $baseDir = $this->view->baseDir() ?? SFW_PROJECT_ROOT . '/resources/views';

        $templateResult = $this->findTemplate($baseDir, $name);

        if (!$templateResult)
            throw new \Exception("View not found: $name.");

        $meta = compact('name', 'baseDir') + $templateResult;

        return $meta;
    }

    /**
     * テンプレートを探す
     */
    private function findTemplate(string $baseDir, string $name): ?array
    {
        foreach (self::FILE_TYPES as $type) {
            $path = $baseDir . '/' . str_replace('.', '/', $name) . '.' . $type . '.php';
            if (file_exists($path)) {
                return compact('type') + $this->getPathInfo($path, $type);
            }
        }

        return null;
    }

    /**
     * パス情報を返す
     */
    private function getPathInfo(string $path, string $type): ?array
    {
        if ($type === 'sfw.blade') {
            return $this->SfwTemplate->getPathInfo($path);
        }

        return compact('path');
    }
}
