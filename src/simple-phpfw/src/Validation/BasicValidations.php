<?php

namespace SFW\Validation;

use SFW\Core\Lang;

/**
 * 基本のバリデーション
 */
trait BasicValidations
{
    /** 必須項目チェック */
    protected function validate_required($field, $value)
    {
        if ($this->isBlank($value)) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.required', ['label' => $label]);
        }
    }

    /** メール検査 */
    protected function validate_email($field, $value)
    {
        if ($this->isBlank($value)) return;

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.email', ['label' => $label]);
        }
    }

    /** 数値検査 */
    protected function validate_numeric($field, $value)
    {
        if ($this->isBlank($value)) return;

        if (!is_numeric($value)) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.numeric', ['label' => $label]);
        }
    }

    /** 最小値検査 */
    protected function validate_min($field, $value, $params)
    {
        if ($this->isBlank($value)) return;

        $min = $params[0];
        if (is_numeric($value) && $value < $min) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.min', ['label' => $label, 'min' => $min]);
        }
    }

    /** 最大値検査 */
    protected function validate_max($field, $value, $params)
    {
        if ($this->isBlank($value)) return;

        $max = $params[0];
        if (is_numeric($value) && $value > $max) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.max', ['label' => $label, 'max' => $max]);
        }
    }

    /** 値の確認の検査 */
    protected function validate_confirm($field, $value)
    {
        if ($this->isBlank($value)) return;

        $confirmValue = $this->data[$field . '_confirm'];

        if ($value !== $confirmValue) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.confirm', ['label' => $label]);
        }
    }

    /** DBユニーク値の検査 */
    protected function validate_unique($field, $value, $params)
    {
        if ($this->isBlank($value)) return;

        $column = $params[0];
        $query = $params[1];

        $row = $query
            ->column('count(*) as cnt')
            ->where("$column = ?", $value)
            ->one();

        $cnt = $row['cnt'];

        if ($cnt > 0) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.unique', ['label' => $label]);
        }
    }
}
