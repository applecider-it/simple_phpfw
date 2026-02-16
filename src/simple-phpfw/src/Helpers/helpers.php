<?php

namespace SFW\Helpers;

use SFW\Output\Html;

/**
 * エスケープ
 */
function html_esc(mixed $val): string {
    return Html::esc($val);
}