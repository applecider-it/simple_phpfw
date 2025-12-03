<?php

namespace App\Services\Commands\GeneratorService;

use SFW\Data\Str;

/**
 * コントローラージェネレーター
 */
class ControllerGenerator
{
    /** コントローラージェネレーター */
    public function exec(array $params)
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
