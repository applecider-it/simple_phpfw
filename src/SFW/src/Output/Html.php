<?php

namespace SFW\Output;

/**
 * HTML関連
 */
class Html
{
    /** エスケープ */
    public static function esc(string $value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
