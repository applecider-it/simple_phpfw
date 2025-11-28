<?php

namespace SFW\Output;

use SFW\Data\Str;

/**
 * 標準出力関連
 */
class StdOut
{
    /**
     * テーブル状に出力
     * 
     * 最初の行はヘッダー扱いされる
     */
    public static function table(array $argRows)
    {
        $margin = 2;
        $separator = '|';
        $lineStr = '-';

        // カラムのキーをそろえる
        $rows = array_map('array_values', $argRows);

        // 各列の最大値を取得
        $colWidths = [];
        foreach ($rows as $row) {
            foreach ($row as $i => $col) {
                $colWidths[$i] = max($colWidths[$i] ?? 0, mb_strwidth((string)$col));
            }
        }

        // 行の横幅
        $lineWidth = array_sum($colWidths) + (count($colWidths) * ($margin + 3)) + 1;

        // ラインを描画する為のクロージャー
        $drawLine = function () use ($lineWidth, $lineStr) {
            echo str_repeat($lineStr, $lineWidth) . PHP_EOL;
        };

        // 出力

        $drawLine();

        $isHeader = true;
        foreach ($rows as $row) {
            foreach ($row as $i => $col) {
                echo $separator . ' ' . Str::mb_str_pad($col, $colWidths[$i] + $margin, pad_type: STR_PAD_RIGHT) . ' ';
            }
            echo $separator;
            echo PHP_EOL;

            // ヘッダー行では線を引く
            if ($isHeader) $drawLine();

            $isHeader = false;
        }

        $drawLine();
    }

    /**
     * 色を付ける
     */
    public static function color(string $color)
    {
        $colors = [
            'red' => "\e[31m",
        ];

        echo $colors[$color];
    }

    /**
     * 色をリセット
     */
    public static function reset()
    {
        echo "\e[0m";
    }
}
