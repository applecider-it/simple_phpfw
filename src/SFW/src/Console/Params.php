<?php

namespace SFW\Console;

/**
 * パラメーター処理
 */
class Params
{
    /**
     * パラメーター生成
     * 
     * オプション形式
     * 
     * --key=value  値指定
     * --key        フラグ扱い
     */
    public static function makeParams(array $params)
    {
        $options = [];
        $positional = [];

        foreach ($params as $param) {
            if (substr($param, 0, 2) === "--") {
                // --key=value形式か、--key形式の時

                $keyAndValue = substr($param, 2);

                if (strpos($param, "=") !== false) {
                    // --key=value形式の時
                    // 値指定

                    [$key, $value] = explode("=", $keyAndValue, 2);
                    $options[$key] = $value;
                } else {
                    // --key形式の時
                    // フラグ扱い

                    $key = $keyAndValue;
                    $options[$key] = true;
                }
            } else {
                $positional[] = $param;
            }
        }

        return [
            'params' => $positional,
            'options' => $options,
        ];
    }
}
