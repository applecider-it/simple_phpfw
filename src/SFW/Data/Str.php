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
}
