<?php

declare(strict_types=1);

namespace SFW\JWT;

/**
 * JWTクリエーター
 */
class Create
{
    /** JWTを生成 */
    public static function createJwt($payload, $secret): string
    {
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];

        $header_encoded = Base64::urlEncode(json_encode($header));
        $payload_encoded = Base64::urlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true);
        $signature_encoded = Base64::urlEncode($signature);

        return "$header_encoded.$payload_encoded.$signature_encoded";
    }
}
