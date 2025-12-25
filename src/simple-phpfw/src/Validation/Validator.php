<?php

namespace SFW\Validation;

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
}
