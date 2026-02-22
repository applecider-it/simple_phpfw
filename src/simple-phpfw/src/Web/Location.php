<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * ロケーション管理
 */
class Location
{
    /** リダイレクト */
    public static function redirect($urlOrUri): void {
        header('Location: ' . $urlOrUri);
        throw new \SFW\Exceptions\Interruption;
    }
}
