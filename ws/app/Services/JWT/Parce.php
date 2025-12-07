<?php

namespace App\Services\JWT;

/**
 * JWTパーサー
 */
class Parce
{
    /** JWTトークンをパース */
    public static function verify_jwt($jwt, $secret)
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) return false;

        list($header_encoded, $payload_encoded, $signature_provided) = $parts;

        // 署名を再生成
        $signature = Base64::urlEncode(
            hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true)
        );

        // 署名一致確認
        if (!hash_equals($signature, $signature_provided)) return false;

        // ペイロードを取得
        $payload = json_decode(Base64::urlDecode($payload_encoded), true);

        // exp 設定があれば期限チェック
        if (isset($payload['exp']) && time() >= $payload['exp']) return false;

        return $payload;
    }
}
