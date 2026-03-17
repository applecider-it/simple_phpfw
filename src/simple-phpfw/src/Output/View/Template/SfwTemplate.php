<?php

declare(strict_types=1);

namespace SFW\Output\View\Template;

/**
 * SFW用テンプレート管理
 */
class SfwTemplate
{
    /**
     * パス情報を返す
     */
    public function getPathInfo(string $path): ?array
    {
        /** @var string テンポラリーファイルパス */
        $tmpPath = SFW_PROJECT_ROOT . '/storage/views/' . Util::tempFileName($path);

        $needGenerate = Util::checkGenarate($path, $tmpPath);

        if ($needGenerate) {
            // テンポラリーファイル生成が必要な時

            $templateData = file_get_contents($path);
            $resultTemplateData = $this->convertTemplate($templateData);
            file_put_contents($tmpPath, $resultTemplateData);

            //echo "create";
        }

        return [
            'path' => $tmpPath,
            'srcPath' => $path,
        ];
    }

    /**
     * テンプレート変換
     * 
     * {{ $val }} -> <?= \SFW\Output\Html::esc($val) ?>
     * {!! $val !!} -> <?= $val ?>
     */
    private function convertTemplate(string $templateData): string
    {
        $templateData = preg_replace(
            '/\{\{\s*(.*?)\s*\}\}/',
            '<?= \SFW\Output\Html::esc($1) ?>',
            $templateData
        );

        $templateData = preg_replace(
            '/\{\!\!\s*(.*?)\s*\!\!\}/',
            '<?= $1 ?>',
            $templateData
        );

        return $templateData;
    }
}
