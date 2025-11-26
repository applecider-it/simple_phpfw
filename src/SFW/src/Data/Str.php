<?php

namespace SFW\Data;

/**
 * 文字列関連
 */
class Str
{
    /**
     * {}文字列を、置き換える
     * 
     * xxxxx{name}xxxxx, ['name' => 'Value']
     */
    public static function template(string $text, array $vars): string
    {
        foreach ($vars as $key => $val) {
            $text = str_replace("{" . $key . "}", $val, $text);
        }
        return $text;
    }

    /**
     * マルチバイト文字に対応した str_pad (全角は幅2、半角は幅1)
     * 
     * フラグは、str_padのフラグを流用している。
     *
     * @param string $input  対象文字列
     * @param int    $pad_length  出力したい幅（※全角2、半角1でカウント）
     * @param string $pad_string  追加する文字
     * @param int    $pad_type  STR_PAD_RIGHT / STR_PAD_LEFT / STR_PAD_BOTH
     * @return string
     */
    public static function mb_str_pad(
        string $input,
        int $pad_length,
        string $pad_string = ' ',
        int $pad_type = STR_PAD_RIGHT
    ): string {
        // 現在の文字列幅（全角は幅2、半角は幅1として計算）
        $width = mb_strwidth($input);

        // すでに希望幅以上の場合はそのまま返す
        if ($width >= $pad_length) {
            return $input;
        }

        // 追加すべき幅
        $pad_size = $pad_length - $width;

        // STR_PAD_BOTH（左右）の場合は左右のバランス調整
        if ($pad_type === STR_PAD_BOTH) {
            $left_pad  = floor($pad_size / 2);
            $right_pad = $pad_size - $left_pad;
            return str_repeat($pad_string, $left_pad) . $input . str_repeat($pad_string, $right_pad);
        }

        // STR_PAD_LEFT
        if ($pad_type === STR_PAD_LEFT) {
            return str_repeat($pad_string, $pad_size) . $input;
        }

        // STR_PAD_RIGHT
        return $input . str_repeat($pad_string, $pad_size);
    }
}
