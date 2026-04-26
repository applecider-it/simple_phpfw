<?php

declare(strict_types=1);

namespace SFW\Web;

use SFW\Data\Arr;

/**
 * Json管理
 */
class Json
{
    /** Jsonのリクエストか返す */
    public static function isJsonRequest(): bool
    {
        $contetType = $_SERVER["CONTENT_TYPE"] ?? '';
        $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';

        return
            stripos($contetType, "application/json") !== false
            || strtolower($xhr) === 'xmlhttprequest';
    }

    /** Jsonのリクエストデータを取得 */
    public static function getJsonRequestData(): array
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        return $data;
    }

    /** Jsonヘッダー送信 */
    public static function sendJsonHeader(): void
    {
        header("Content-Type: application/json; charset=utf-8");
    }
}
