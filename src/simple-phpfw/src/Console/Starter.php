<?php

declare(strict_types=1);

namespace SFW\Console;

/**
 * コンソール管理
 */
class Starter
{
    private Process $process;

    public function __construct()
    {
        $this->process = new Process;
    }

    /** 実行 */
    public function dispatch(array $argv): void
    {
        $conf = [
            [
                'path' => SFW_PROJECT_ROOT . '/app/Commands',
                'prefix' => "App\\Commands",
            ],
            [
                'path' => __DIR__ . '/Commands',
                'prefix' => "SFW\\Console\\Commands",
            ],
        ];

        // 実行ファイル除去
        array_shift($argv);

        $ret = $this->process->dispatch($argv, $conf);
        if (! $ret) return;

        $this->runHandler($ret['class'], $ret['params']);
    }

    /** ハンドラーを実行 */
    private function runHandler(string $class, array $params): void
    {
        /** @var \SFW\Console\Command */
        $obj = new $class();

        $ret = Params::makeParams($params);

        $obj->params = $ret['params'];
        $obj->options = $ret['options'];

        $obj->handle();
    }
}
