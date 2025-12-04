<?php

namespace App\Generators;

use SFW\Data\Str;

/**
 * コントローラージェネレーター
 */
class ControllerGenerator extends Generator
{
    /** ジェネレーターコマンド名 */
    public static string $name = 'controller';

    /** ジェネレーターコマンド説明 */
    public static string $desc = 'コントローラー生成';

    /** ジェネレーターコマンド説明の詳細 */
    public static string $descDetail = 'パラメーター
controller action action ...

controllerはパスカルケース
ディレクトリの区切りは /

actionはスネークケース
';

    /** 生成情報を作成 */
    public function conf(array $params, array $options)
    {
        $controller = array_shift($params);

        echo "controller: $controller\n";
        if (! $controller) {
            echo "controller is blank.\n";
            return;
        }

        $actions = $params;

        $info = $this->createInfo($controller);
        $controllerName = $info['controllerName'];
        $controllerNamespace = $info['controllerNamespace'];
        $viewPrefix = $info['viewPrefix'];
        $viewSubPath = $info['viewSubPath'];

        $conf = [];

        $data = [
            'actions' => $actions,
            'controllerName' => $controllerName,
            'controllerNamespace' => $controllerNamespace,
            'viewPrefix' => $viewPrefix,
        ];

        $conf[] = [
            'name' => 'generators.controller.controller',
            'path' => SFW_PROJECT_ROOT . "/app/Controllers/" . $controller . "Controller.php",
            'data' => $data,
        ];

        foreach ($actions as $action) {
            $conf[] = [
                'name' => 'generators.controller.view',
                'path' => SFW_PROJECT_ROOT . "/resources/views/{$viewSubPath}/{$action}.html.php",
                'data' => $data + ['action' => $action],
            ];
        }

        return $conf;
    }

    /** 基本情報を生成 */
    private function createInfo(string $controller)
    {
        $arr = explode('/', $controller);

        $arrSnake = array_map(fn($v) => Str::pascalToSnake($v), $arr);

        $viewPrefix = implode('.', $arrSnake);
        $viewSubPath = implode('/', $arrSnake);

        $name = array_pop($arr);
        $namespace = implode('\\', $arr);

        return [
            'controllerName' => $name,
            'controllerNamespace' => $namespace,
            'viewPrefix' => $viewPrefix,
            'viewSubPath' => $viewSubPath,
        ];
    }
}
