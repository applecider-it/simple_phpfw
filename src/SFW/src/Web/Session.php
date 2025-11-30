<?php

namespace SFW\Web;

/**
 * セッション管理
 */
class Session
{
    /** セッション開始 */
    public static function start() {
        $lifetime = 60 * 60 * 24 * 30;
        session_set_cookie_params($lifetime);
        session_start();
    }

    /** セッションを設定 */
    public static function set(string $key, $val) {
        $_SESSION[$key] = $val;
    }

    /** セッションを取得 */
    public static function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    /** セッションを破棄 */
    public static function clear(string $key) {
        unset($_SESSION[$key]);
    }

    /** セッションIDを新しくする */
    public static function reflesh() {
        session_regenerate_id(true);
    }
}
