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
            Process::HELP_COMMAND_NAME,
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

    /** コマンド詳細表示 */
    public function outputCommandDetail(array $commandInfo)
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
