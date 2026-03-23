<?php

declare(strict_types=1);

namespace SFW\Output\View;

use SFW\Output\View;

use SFW\Output\View\Templates\SfwTemplate;

/**
 * テンプレート管理
 */
class Template
{
    /** View管理 */
    private View $view;

    /** SFW用テンプレート管理 */
    private array $templates = [];

    /** テンプレートファイルタイプリスト */
    private const FILE_TYPES = [
        'html', // PHPテンプレート
        'sfw', // 独自テンプレート
    ];

    function __construct(View $view)
    {
        $this->view = $view;

        $this->templates['sfw'] = new SfwTemplate;
    }

    /**
     * 描画情報を返す
     * 
     * 必要な場合は、テンポラリーファイルを生成する。
     * 
     * テンプレートがないときは例外
     * 
     * 戻り値  
     * $typeが`html`の時  
     * [name => string, baseDir => string, type => string, path => string,]  
     * それ以外  
     * [name => string, baseDir => string, type => string, path => string, srcPath => string]  
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
     * 
     * 戻り値
     * 
     * テンプレートがないときはnull
     * 
     * $typeが`html`の時  
     * [type => string, path => string,]  
     * それ以外  
     * [type => string, path => string, srcPath => string]  
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
     * 
     * 戻り値
     * 
     * $typeが`html`の時  
     * [path => string,]  
     * それ以外  
     * [path => string, srcPath => string]  
     */
    private function getPathInfo(string $path, string $type): array
    {
        if ($type !== 'html') {
            return $this->getGenartedPathInfo($path, $type);
        }

        return compact('path');
    }

    /**
     * テンポラリーファイルなどを含んだパス情報を返す
     * 
     * 必要な時は、テンポラリーファイルを生成する。
     */
    private function getGenartedPathInfo(string $path, string $type): array
    {
        /** @var string テンポラリーファイルパス */
        $tmpPath = SFW_PROJECT_ROOT . '/storage/views/' . Template\File::tempFileName($path);

        $needGenerate = Template\File::checkGenarate($path, $tmpPath);

        if ($needGenerate) {
            // テンポラリーファイル生成が必要な時

            // テンポラリーファイル生成
            $templateData = file_get_contents($path);
            $resultTemplateData = $this->templates[$type]->convertTemplate($templateData);
            file_put_contents($tmpPath, $resultTemplateData);

            //echo "create";
        }

        return [
            'path' => $tmpPath, // SFW\View\Loaderクラスから読み込まれるのはテンポラリーファイルのほう
            'srcPath' => $path,
        ];
    }
}
