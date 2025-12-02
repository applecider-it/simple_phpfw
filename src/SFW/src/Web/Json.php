<?php

namespace SFW\Web;

/**
 * Json管理
 */
class Json
{
    /** Jsonのリクエストか返す */
    public static function isJsonRequest()
    {
        return isset($_SERVER["CONTENT_TYPE"]) &&
            stripos($_SERVER["CONTENT_TYPE"], "application/json") !== false;
    }

    /** Jsonのリクエストデータを取得 */
    public static function getJsonRequestData()
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        return $data;
    }

    /** Jsonヘッダー送信 */
    public static function sendJsonHeader()
    {
        header("Content-Type: application/json; charset=utf-8");
    }
}
