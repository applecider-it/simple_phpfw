<?php

declare(strict_types=1);

namespace SFW\Data;

/**
 * 例外データ管理
 */
class Exception
{
    /** 全ての例外をリストにする */
    public static function getExceptions(\Throwable $e): array
    {
        $list = [];
        $list[] = $e;
        while ($e->getPrevious() !== null) {
            $e = $e->getPrevious();
            $list[] = $e;
        }
        return $list;
    }
}
