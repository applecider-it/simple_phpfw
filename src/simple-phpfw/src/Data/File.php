<?php

declare(strict_types=1);

namespace SFW\Data;

/**
 * ファイル関連
 */
class File
{
    /** ファイルを読み込んで、指定行数の範囲だけ配列で取得 */
    public static function getLinesAround($filePath, $targetLine, $range = 5)
    {
        // ファイルを配列として読み込む（1行 = 1要素）
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);

        // 総行数
        $total = count($lines);

        // 開始・終了行を計算（0始まりに注意）
        $start = max(0, $targetLine - 1 - $range);
        $end   = min($total - 1, $targetLine - 1 + $range);

        // 指定範囲を切り出し
        return array_slice($lines, $start, $end - $start + 1, true);
    }
}
