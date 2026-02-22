<?php

declare(strict_types=1);

namespace SFW\Database;

/**
 * エスケープしない値
 */
class Raw
{
    public function __construct(public readonly mixed $value) {}
}
