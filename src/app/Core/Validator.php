<?php

namespace App\Core;

use SFW\Validation\Validator as BaseValidator;
use SFW\Validation\BasicValidations;

/**
 * 値検査
 */
class Validator extends BaseValidator
{
    use BasicValidations;
    use CustomValidations;
}
