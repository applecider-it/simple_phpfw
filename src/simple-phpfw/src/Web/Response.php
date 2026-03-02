<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * レスポンス管理
 */
class Response
{
    /** 処理できないエンティティ (入力エラー) */
    public const int UNPROCESSABLE_ENTITY = 422;

    /** HTTPレスポンスコード */
    public static function code(int $code): void
    {
        $conf = [
            self::UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        ];

        if (isset($conf[$code])) {
            header('HTTP/1.1 ' . $code . ' ' . $conf[$code]);
        } else {
            http_response_code($code);
        }
    }
}
