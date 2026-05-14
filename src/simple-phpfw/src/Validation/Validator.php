<?php

declare(strict_types=1);

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

    public function valid(): bool
    {
        return !$this->fails();
    }

    public function errors(): array
    {
        return $this->errors;
    }

    protected function getLabel(string $field): string
    {
        return $this->labels[$field] ?? $field;
    }

    /**
     * 検査実行
     */
    private function validate(): void
    {
        foreach ($this->rules as $field => $ruleArray) {
            if (!is_array($ruleArray)) {
                throw new \Exception("Validation rules must be an array for field '{$field}'");
            }

            $value = $this->data[$field] ?? null;

            $this->validateValue($field, $value, $ruleArray);
        }
    }

    /**
     * １項目だけ、検査実行
     * 
     * ruleがnullableの時は、特殊な処理が入る
     */
    private function validateValue(string $field, mixed $value, array $ruleArray): void
    {
        /** @var bool これがtrueの時はnullを許容する */
        $nullable = false;

        foreach ($ruleArray as $ruleValue) {
            // [rule, param1, param2 ....]
            $ruleValue = (array) $ruleValue;

            $rule = array_shift($ruleValue);
            $params = $ruleValue;

            if ($rule === 'nullable') {
                // nullableが指定されたとき

                $nullable = true;
                continue;
            }

            $method = "validate_" . $rule;

            if (method_exists($this, $method)) {
                // ruleが存在する時

                if ($nullable) {
                    // nullを許容する時

                    if ($this->isBlank($value)) {
                        continue;
                    }
                }

                $this->$method($field, $value, $params);
            } else {
                throw new \Exception("Validation rule '{$rule}' not implemented");
            }
        }
    }

    /** 空白チェック */
    protected function isBlank(mixed $value): bool
    {
        return ($value === null || $value === '' || (is_array($value) && empty($value)));
    }
}
