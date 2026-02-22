<?php

declare(strict_types=1);

namespace SFW\Generator;

use SFW\Console\Process;

/**
 * ジェネレーター処理
 */
class Starter
{
    private Process $process;

    public function __construct()
    {
        $this->process = new Process;
    }

    /** 実行 */
    public function exec(array $params, array $options): void
    {
        $conf = [
            [
                'path' => SFW_PROJECT_ROOT . '/app/Generators',
                'prefix' => "App\\Generators",
            ],
        ];

        $ret = $this->process->dispatch($params, $conf);
        if (! $ret) return;

        $this->runHandler($ret['class'], $ret['params'], $options);
    }

    /** ハンドラーを実行 */
    private function runHandler($class, array $params, array $options): void
    {
        $dryrun = $options['dryrun'] ?? false;

        /** @var \SFW\Generator\Generator */
        $obj = new $class();

        echo "generator: $class\n";
        echo "dryrun: $dryrun\n";

        $conf = $obj->conf($params, $options);

        foreach ($conf as $row) {
            $path = $row['path'];
            $name = $row['name'];
            $data = $row['data'];

            Creator::output($name, $path, $data, $dryrun);
        }
    }
}
