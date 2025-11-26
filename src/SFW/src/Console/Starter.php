<?php

namespace SFW\Console;

use SFW\Data\Path;
use SFW\Output\StdOut;

/**
 * コンソール管理
 */
class Starter
{
    /** 実行 */
    public function dispatch($argv)
    {
        // 実行ファイル除去
        array_shift($argv);

        $commandName = array_shift($argv);

        $commandData = $this->getCommandData($commandName);

        // コマンドがないときはコマンド一覧表示
        if (! $commandData['currentCommandInfo']) {
            if ($commandName) {
                echo "$commandName command is not found." . PHP_EOL;
            }

            $this->outputCommandInfos($commandData['commandInfos']);
            return;
        }

        $class = $commandData['currentCommandInfo']['class'];
        $this->runHandler($class, $argv);
    }

    /** コマンド情報取得 */
    private function getCommandData(?string $commandName)
    {
        $path = SFW_PROJECT_ROOT . '/App/Commands';

        $phpFiles = Path::scanPhpFiles($path);

        $commandInfos = [];
        $currentCommandInfo = null;
        foreach ($phpFiles as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $class = "App\\Commands\\{$name}";

            // クラス変数からコマンド名と説明文を取得
            $command = $class::$name;
            $desc = $class::$desc;

            // ApplicationCommandなどは、コマンドがないのでスキップ
            if (empty($command)) continue;

            $commandInfo = [
                'class' => $class,
                'command' => $command,
                'desc' => $desc,
            ];

            $commandInfos[] = $commandInfo;

            if ($commandName === $command) {
                $currentCommandInfo = $commandInfo;
            }
        }

        return [
            'commandInfos' => $commandInfos,
            'currentCommandInfo' => $currentCommandInfo,
        ];
    }

    /** コマンド情報表示 */
    private function outputCommandInfos(array $commandInfos)
    {
        $rows = [];
        $rows[] = [
            'Command',
            'Description',
            'Class',
        ];
        foreach ($commandInfos as $commandInfo) {
            $rows[] = [
                $commandInfo['command'],
                $commandInfo['desc'],
                $commandInfo['class'],
            ];
        }

        StdOut::table($rows);
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
