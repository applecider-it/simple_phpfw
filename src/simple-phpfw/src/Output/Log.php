<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Core\Config;

/**
 * ログ管理
 */
class Log
{
    /** 情報ログ */
    public static function info(string $msg, ?array $context = null): void
    {
        self::write('INFO',  $msg, $context);
    }

    /** エラーログ */
    public static function error(string $msg, ?array $context = null): void
    {
        self::write('ERROR',  $msg, $context);
    }

    /** ログ出力共通 */
    private static function write(string $level, string $message, ?array $context): void
    {
        $date = date('Y-m-d H:i:s');
        $logFile = Config::get('logging.' . SFW_BOOT_TYPE . '.file');

        if (! is_null($context)) {
            $message .= ' ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }

        $line = "[$date][$level] $message" . PHP_EOL;
        file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    }
}
