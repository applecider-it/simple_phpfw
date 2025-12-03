<?php

namespace SFW\Console;

use SFW\Data\Path;

/**
 * コンソールプロセス管理
 */
class Process
{
    public const HELP_COMMAND_NAME = 'help';

    private Trace $trace;

    public function __construct()
    {
        $this->trace = new Trace;
    }

    /** 実行 */
    public function dispatch($argv, $conf)
    {
        $commandName = array_shift($argv);

        $commandInfos = $this->getCommandInfos($conf);
        $currentCommandInfo = $this->getCurrentCommandInfo($commandName, $commandInfos);

        // ヘルプコマンドの時はヘルプ処理
        if ($commandName == self::HELP_COMMAND_NAME) {
            $this->helpProccess($argv, $commandInfos);
            return null;
        }

        // コマンドがないときはコマンド一覧表示
        if (! $currentCommandInfo) {
            if ($commandName) {
                echo "$commandName command not found." . str_repeat(PHP_EOL, 2);
            }

            $this->trace->outputCommandInfos($commandInfos);
            return null;
        }

        $class = $currentCommandInfo['class'];

        return [
            'class' => $class,
            'params' => $argv,
        ];
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
        $index = array_search($commandName, array_column($commandInfos, 'command'));
        return $index !== false ? $commandInfos[$index] : null;
    }

    /** コマンド一覧取得 */
    private function getCommandInfos($conf)
    {
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
}
