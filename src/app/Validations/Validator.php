<?php

namespace App\Validations;

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
