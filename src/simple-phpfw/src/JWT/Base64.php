<?php

namespace SFW\JWT;

/**
 * JWTのBase64処理
 */
class Base64
{
    /** JWT用のBase64エンコード */
    public static function urlEncode($data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /** JWT用のBase64デコード */
    public static function urlDecode($data): string|false
    {
        $remainder = strlen($data) % 4;
        if ($remainder) $data .= str_repeat('=', 4 - $remainder);
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
