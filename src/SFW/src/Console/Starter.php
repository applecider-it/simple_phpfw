<?php

namespace SFW\Console;

use SFW\Data\Path;

/**
 * コンソール管理
 */
class Starter
{
    public const HELP_COMMAND_NAME = 'help';

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

        $commandInfos = $this->getCommandInfos();
        $currentCommandInfo = $this->getCurrentCommandInfo($commandName, $commandInfos);

        // ヘルプコマンドの時はヘルプ処理
        if ($commandName == self::HELP_COMMAND_NAME) {
            $this->helpProccess($argv, $commandInfos);
            return;
        }

        // コマンドがないときはコマンド一覧表示
        if (! $currentCommandInfo) {
            if ($commandName) {
                echo "$commandName command not found." . str_repeat(PHP_EOL, 2);
            }

            $this->trace->outputCommandInfos($commandInfos);
            return;
        }

        $class = $currentCommandInfo['class'];
        $this->runHandler($class, $argv);
    }

    /** ヘルプ処理 */
    private function helpProccess(array $argv, array $commandInfos)
    {
        $target = array_shift($argv);
        if (! $target) {
            echo "Select the command for which you want to view details." . str_repeat(PHP_EOL, 2);
            $this->trace->outputCommandInfos($commandInfos);
            return;
        }

        $tergetCommandInfo = $this->getCurrentCommandInfo($target, $commandInfos);
        if (! $tergetCommandInfo) {
            echo "Help cannot be displayed because there is no {$target} command." . str_repeat(PHP_EOL, 2);
            $this->trace->outputCommandInfos($commandInfos);
            return;
        }

        $this->trace->outputCommandDetail($tergetCommandInfo);
    }

    /** 対象のコマンド情報取得 */
    private function getCurrentCommandInfo(?string $commandName, array $commandInfos)
    {
        $currentCommandInfo = null;

        foreach ($commandInfos as $commandInfo) {
            if ($commandInfo['command'] === $commandName) {
                $currentCommandInfo = $commandInfo;
                break;
            }
        }

        return $currentCommandInfo;
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
