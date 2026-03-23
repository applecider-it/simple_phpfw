<?php

declare(strict_types=1);

namespace SFW\Output\View\Templates;

/**
 * テンプレートベース
 */
abstract class Base
{
    /** テンプレート変換 */
    abstract public function convertTemplate(string $templateData): string;
}
