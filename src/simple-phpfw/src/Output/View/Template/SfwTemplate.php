<?php

declare(strict_types=1);

namespace SFW\Output\View\Template;

/**
 * SFW用テンプレート管理
 */
class SfwTemplate extends Base
{
    /**
     * テンプレート変換
     * 
     * {{ $val }} -> <?= \SFW\Output\Html::esc($val) ?>
     */
    public function convertTemplate(string $templateData): string
    {
        $templateData = preg_replace(
            '/\{\{\s*(.*?)\s*\}\}/s',
            '<?= \SFW\Output\Html::esc($1) ?>',
            $templateData
        );

        return $templateData;
    }
}
