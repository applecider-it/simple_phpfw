<?php

namespace SFW\JWT;

/**
 * JWTクリエーター
 */
class Create
{
    private static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function create_jwt($payload, $secret)
    {
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];

        $header_encoded = self::base64url_encode(json_encode($header));
        $payload_encoded = self::base64url_encode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true);
        $signature_encoded = self::base64url_encode($signature);

        return "$header_encoded.$payload_encoded.$signature_encoded";
    }
}
