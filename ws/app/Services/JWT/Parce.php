<?php

namespace App\Services\JWT;

/**
 * JWTパーサー
 */
class Parce
{
    private static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64url_decode($data)
    {
        $remainder = strlen($data) % 4;
        if ($remainder) $data .= str_repeat('=', 4 - $remainder);
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function verify_jwt($jwt, $secret)
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) return false;

        list($header_encoded, $payload_encoded, $signature_provided) = $parts;

        // 署名を再生成
        $signature = self::base64url_encode(
            hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true)
        );

        // 署名一致確認
        if (!hash_equals($signature, $signature_provided)) return false;

        // ペイロードを取得
        $payload = json_decode(self::base64url_decode($payload_encoded), true);

        // exp 設定があれば期限チェック
        if (isset($payload['exp']) && time() >= $payload['exp']) return false;

        return $payload;
    }
}
