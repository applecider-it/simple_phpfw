<?php

namespace SFW\Core;

use SFW\Core\App;
use SFW\Output\StdOut;

/**
 * トレース管理
 */
class Trace
{
    /** コンテナデータを標準出力 */
    public static function traceContainer()
    {
        $all = App::getContainer()->getAll();

        $header = [
            'Key',
            'Name',
            'Value',
        ];

        $rows = [];
        foreach ($all as $key => $row) {
            $value = $row['value'];
            $name = $row['name'];
            $row = [
                'key' => $key,
                'name' => $name,
                'value' => (is_object($value) ? get_class($value) : gettype($value)),
            ];

            $rows[] = $row;
        }

        // パスの昇順でソート
        $keys = array_column($rows, 'key');
        array_multisort($keys, SORT_ASC, $rows);

        StdOut::table([$header, ...$rows]);
    }
}
