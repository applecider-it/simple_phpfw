<?php

namespace SFW\Console;

use SFW\Output\StdOut;

/**
 * コンソールのトレース管理
 */
class Trace
{
    /** コマンド情報表示 */
    public function outputCommandInfos(array $commandInfos)
    {
        $rows = [];
        $rows[] = [
            'Command',
            'Description',
            'Class',
        ];
        $rows[] = [
            Starter::helpCommandName,
            'ヘルプ表示',
            '',
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

    /** コマンドヘルプ表示 */
    public function outputCommandHelp(array $commandInfos, $target)
    {
        if (! $target) {
            echo "Select the command for which you want to view details." . PHP_EOL;
            return;
        }

        foreach ($commandInfos as $commandInfo) {
            if ($commandInfo['command'] === $target) {
                $this->outputCommandDetail($commandInfo);
                return;
            }
        }

        echo "{$target} command not found." . PHP_EOL;
    }

    /** コマンド詳細表示 */
    private function outputCommandDetail(array $commandInfo)
    {
        echo "Class:" . PHP_EOL;
        echo $commandInfo['class'] . PHP_EOL;
        echo PHP_EOL;

        echo "Command:" . PHP_EOL;
        echo $commandInfo['command'] . PHP_EOL;
        echo PHP_EOL;

        echo "Desc:" . PHP_EOL;
        echo $commandInfo['desc'] . PHP_EOL;
        echo PHP_EOL;

        echo "Desc Detail:" . PHP_EOL;
        echo $commandInfo['descDetail'] . PHP_EOL;
        echo PHP_EOL;
    }
}
