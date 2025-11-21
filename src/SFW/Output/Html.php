<?php

namespace SFW\Output;

class Html
{
    public static function esc(string $value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
