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
controller action action ...';

    /** 生成情報を作成 */
    public function conf(array $params, array $options)
    {
        $controller = array_shift($params);
        $controllerSnake = Str::pascalToSnake($controller);
        echo "controller: $controller\n";
        echo "controllerSnake: $controllerSnake\n";
        if (! $controller) {
            echo "controller is blank.\n";
            return;
        }

        $actions = $params;

        $conf = [];

        $data = [
            'controller' => $controller,
            'controllerSnake' => $controllerSnake,
        ];

        $conf[] = [
            'name' => 'generators.controller.controller',
            'path' => SFW_PROJECT_ROOT . "/app/Controllers/" . $controller . "Controller.php",
            'data' => $data + ['actions' => $actions],
        ];

        foreach ($actions as $action) {
            $conf[] = [
                'name' => 'generators.controller.view',
                'path' => SFW_PROJECT_ROOT . "/resources/views/{$controllerSnake}/{$action}.html.php",
                'data' => $data + ['action' => $action],
            ];
        }

        return $conf;
    }
}
