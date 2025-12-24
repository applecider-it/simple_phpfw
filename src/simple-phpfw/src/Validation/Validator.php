<?php

namespace SFW\Validation;

use SFW\Core\Lang;

/**
 * 値検査
 */
abstract class Validator
{
    protected array $data;
    protected array $rules;
    protected array $labels;
    protected array $errors = [];

    /** クラス生成と検査実行 */
    public static function make(array $data, array $rules, array $labels = []): static
    {
        $v = new static();
        $v->data = $data;
        $v->rules = $rules;
        $v->labels = $labels;
        $v->validate();
        return $v;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    protected function getLabel(string $field): string
    {
        return $this->labels[$field] ?? $field;
    }

    /** 検査実行 */
    protected function validate()
    {
        foreach ($this->rules as $field => $ruleArray) {
            if (!is_array($ruleArray)) {
                throw new \Exception("Validation rules must be an array for field '{$field}'");
            }

            $value = $this->data[$field] ?? null;

            foreach ($ruleArray as $ruleValue) {
                $rule = null;
                $params = null;

                if (is_array($ruleValue)) {
                    // 配列指定のルール
                    // [rule, param1, param2 ....]

                    $rule = array_shift($ruleValue);
                    $params = $ruleValue;
                } else {
                    // 文字列指定のルール
                    // "rule:param1,param2,...."

                    if (strpos($ruleValue, ':') !== false) {
                        // パラメーターが指定されているとき

                        [$rule, $param] = explode(':', $ruleValue, 2);

                        $params = explode(',', $param);
                    } else {
                        $rule = $ruleValue;
                    }
                }

                $method = "validate_" . $rule;

                if (method_exists($this, $method)) {
                    $this->$method($field, $value, $params);
                } else {
                    throw new \Exception("Validation rule '{$rule}' not implemented");
                }
            }
        }
    }

    /** 空白チェック */
    protected function isBlank($value)
    {
        return ($value === null || $value === '' || (is_array($value) && empty($value)));
    }

    /* ===== rule implementations ===== */

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
