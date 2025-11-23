<?php

namespace App\Core;

use SFW\Validation\Validator as BaseValidator;
use SFW\Core\Lang;

/**
 * 値検査
 * 
 * アプリケーション独自の検査項目を追加するファイル
 */
class Validator extends BaseValidator
{
    /** 独自のチェックロジック */
    protected function validate_original($field, $value, $param)
    {
        $validValue = $this->data[$param[0]] . $this->data[$param[1]];

        if ($value !== $validValue) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.original', ['label' => $label, 'validValue' => $validValue]);
        }
    }
}
