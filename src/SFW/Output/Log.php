<?php

namespace SFW\Output;

/**
 * ログ管理
 */
class Log
{
    /** 情報ログ */
    public static function info(string $msg, array $context = [])
    {
        self::write('INFO',  $msg, $context);
    }

    /** エラーログ */
    public static function error(string $msg, array $context = [])
    {
        self::write('ERROR',  $msg, $context);
    }

    /** ログ出力共通 */
    private static function write(string $level, string $message, array $context = [])
    {
        $date = date('Y-m-d H:i:s');
        $logFile = SFW_PROJECT_ROOT . '/storage/logs/simple_framework.log';

        if (!empty($context)) {
            $message .= ' ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }

        $line = "[$date][$level] $message" . PHP_EOL;
        file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    }
}
