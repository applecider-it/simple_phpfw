<?php

namespace App\Services\Commands;

use SFW\Output\Generator;

/**
 * ジェネレーターコマンド用サービス
 */
class GeneratorService
{
    /** 実行 */
    public function exec(array $params, array $options)
    {
        $generator = array_shift($params);
        $dryrun = $options['dryrun'] ?? false;

        echo "generator: $generator\n";

        if ( ! $generator) {
            echo "generator is blank.\n";
            return;
        }

        $obj = match ($generator) {
            'controller' => new GeneratorService\ControllerGenerator,
            default => null,
        };

        if ( ! $obj) {
            echo "$generator generator is not found.\n";
            return;
        }

        $conf = $obj->exec($params);

        foreach ($conf as $row) {
            $path = $row['path'];
            $name = $row['name'];
            $data = $row['data'];

            Generator::output($name, $path, $data, $dryrun);
        }
    }
}
