<?php

namespace App\Core;

use SFW\Core\Lang;

/**
 * 値検査
 * 
 * アプリケーション独自の検査項目を追加するファイル
 */
trait CustomValidations
{
    /** 独自のチェックロジック */
    protected function validate_original($field, $value, $params)
    {
        if ($this->isBlank($value)) return;

        $validValue = $this->data[$params[0]] . $this->data[$params[1]];

        if ($value !== $validValue) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.original', ['label' => $label, 'validValue' => $validValue]);
        }
    }
}
