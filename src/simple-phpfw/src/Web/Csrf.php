<?php

namespace SFW\Web;

/**
 * CSRF トークン管理
 */
class Csrf
{
    private const CSRF_SESSION_KEY = '___csrf_token';

    /** トークン生成 */
    public static function create()
    {
        Session::set(self::CSRF_SESSION_KEY, bin2hex(random_bytes(32)));
    }

    /** トークンを返す */
    public static function get()
    {
        return Session::get(self::CSRF_SESSION_KEY);
    }

    /** トークンを検査 */
    public static function check(string $token)
    {
        $result = self::get() && hash_equals(self::get(), $token);

        if (! $result) throw new \SFW\Exceptions\Csrf;
    }
}
