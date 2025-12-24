<?php

namespace SFW\Web;

/**
 * フラッシュメッセージ管理
 */
class Flash
{
    private const FLASH_SESSION_KEY = '___flash';

    /** フラッシュを設定 */
    public static function set(string $key, $val) {
        $arr = self::initAndGet();
        $arr[$key] = $val;
        Session::set(self::FLASH_SESSION_KEY, $arr);
   }

    /** フラッシュを取得 */
    public static function get(string $key) {
        $arr = self::initAndGet();
        return $arr[$key] ?? null;
    }

    /** フラッシュを破棄 */
    public static function clear() {
        Session::clear(self::FLASH_SESSION_KEY);
    }

    /** 初期化して現在値を返す */
    public static function initAndGet() {
        if (! Session::get(self::FLASH_SESSION_KEY)) {
            Session::set(self::FLASH_SESSION_KEY, []);
        }
        return Session::get(self::FLASH_SESSION_KEY);
    }
}
