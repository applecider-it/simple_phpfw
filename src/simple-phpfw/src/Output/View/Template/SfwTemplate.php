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
     * {{ $val }} -> <?= $this->h($val) ?>
     */
    public function convertTemplate(string $templateData): string
    {
        /* {{ $val }} -> <?= $this->h($val) ?> */
        $templateData = preg_replace(
            '/\{\{\s*(.*?)\s*\}\}/s',
            '<?= $this->h($1) ?>',
            $templateData
        );

        return $templateData;
    }
}
