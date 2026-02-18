<?php

namespace SFW\Security;

/**
 * ハッシュ（暗号）関連
 */
class Hash
{
    /**
     * ハッシュ生成
     */
    public static function make(mixed $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * ハッシュ確認
     */
    public static function check(string $password, $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}
