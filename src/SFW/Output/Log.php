<?php

namespace SFW\Output;

class Log
{
    public static function info(string $msg, array $context = [])
    {
        self::write('INFO',  $msg, $context);
    }
    public static function sql(string $msg, array $context = [])
    {
        self::write('SQL', $msg, $context);
    }

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
