<?php

namespace SFW\Console;

use SFW\Data\Path;

/**
 * コンソール管理
 */
class Starter
{
    public const helpCommandName = 'help';

    private Trace $trace;

    public function __construct()
    {
        $this->trace = new Trace;
    }

    /** 実行 */
    public function dispatch($argv)
    {
        // 実行ファイル除去
        array_shift($argv);

        $commandName = array_shift($argv);

        $commandData = $this->getCommandData($commandName);

        if ($commandName == self::helpCommandName) {
            $target = array_shift($argv);
            $this->trace->outputCommandHelp($commandData['commandInfos'], $target);
            return;
        }

        // コマンドがないときはコマンド一覧表示
        if (! $commandData['currentCommandInfo']) {
            if ($commandName) {
                echo "$commandName command is not found." . PHP_EOL;
            }

            $this->trace->outputCommandInfos($commandData['commandInfos']);
            return;
        }

        $class = $commandData['currentCommandInfo']['class'];
        $this->runHandler($class, $argv);
    }

    /** コマンド情報取得 */
    private function getCommandData(?string $commandName)
    {
        $commandInfos = $this->getCommandInfos();
        $currentCommandInfo = null;

        foreach ($commandInfos as $commandInfo) {
            if ($commandInfo['command'] === $commandName) {
                $currentCommandInfo = $commandInfo;
                break;
            }
        }

        return [
            'commandInfos' => $commandInfos,
            'currentCommandInfo' => $currentCommandInfo,
        ];
    }

    /** コマンド一覧取得 */
    private function getCommandInfos()
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

        $commandInfos = [];

        foreach ($conf as $row) {
            $path = $row['path'];
            $prefix = $row['prefix'];

            $phpFiles = Path::scanPhpFiles($path);
            foreach ($phpFiles as $file) {
                $name = pathinfo($file, PATHINFO_FILENAME);
                $class = "{$prefix}\\{$name}";

                // クラス変数からコマンド名と説明文を取得
                $command = $class::$name;
                $desc = $class::$desc;
                $descDetail = $class::$descDetail;

                // アプリケーションベースコマンドなどは、コマンドがないのでスキップ
                if (empty($command)) continue;

                $commandInfo = [
                    'class' => $class,
                    'command' => $command,
                    'desc' => $desc,
                    'descDetail' => $descDetail,
                ];

                $commandInfos[] = $commandInfo;
            }
        }

        return $commandInfos;
    }

    /** ハンドラーを実行 */
    private function runHandler($class, $params)
    {
        /** @var \SFW\Console\Command */
        $obj = new $class();

        $ret = Params::makeParams($params);

        $obj->params = $ret['params'];
        $obj->options = $ret['options'];

        $obj->handle();
    }
}
