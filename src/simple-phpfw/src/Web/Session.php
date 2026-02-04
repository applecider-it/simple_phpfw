<?php

namespace SFW\Web;

use SFW\Core\Config;

/**
 * セッション管理
 */
class Session
{
    /** セッション開始 */
    public static function start() {
        $lifetime = Config::get('session.lifetime');
        ini_set('session.gc_maxlifetime', $lifetime);
        session_save_path(Config::get('session.save_path'));
        session_set_cookie_params($lifetime);
        session_name(Config::get('session.name'));
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
