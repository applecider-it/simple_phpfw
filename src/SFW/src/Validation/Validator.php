<?php

namespace SFW\Validation;

use SFW\Core\Lang;

/**
 * 値検査
 */
class Validator
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

            foreach ($ruleArray as $rule) {
                $params = null;

                if (strpos($rule, ':') !== false) {
                    [$rule, $param] = explode(':', $rule, 2);

                    $params = explode(',', $param);
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

    /* ===== rule implementations ===== */

    /** 必須項目チェック */
    protected function validate_required($field, $value)
    {
        if ($value === null || $value === '' || (is_array($value) && empty($value))) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.required', ['label' => $label]);
        }
    }

    /** メール検査 */
    protected function validate_email($field, $value)
    {
        if ($value !== null && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.email', ['label' => $label]);
        }
    }

    /** 数値検査 */
    protected function validate_numeric($field, $value)
    {
        if ($value !== null && !is_numeric($value)) {
            $label = $this->getLabel($field);
            $this->errors[$field][] = Lang::get('validation.errors.numeric', ['label' => $label]);
        }
    }
}
