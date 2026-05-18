<?php
declare(strict_types=1);

namespace App\Core;

class Validator
{
    private array $errors = [];

    /**
     * Rules: ['field' => 'required|email|min:6']
     */
    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $ruleString) {
            $value = $data[$field] ?? null;
            foreach (explode('|', $ruleString) as $rule) {
                [$name, $param] = array_pad(explode(':', $rule, 2), 2, null);
                $this->apply($field, $value, $name, $param);
            }
        }
        return empty($this->errors);
    }

    private function apply(string $field, $value, string $rule, ?string $param): void
    {
        switch ($rule) {
            case 'required':
                if ($value === null || $value === '') $this->errors[$field][] = "$field is required.";
                break;
            case 'email':
                if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) $this->errors[$field][] = "$field must be a valid email.";
                break;
            case 'min':
                if ($value !== null && strlen((string) $value) < (int) $param) $this->errors[$field][] = "$field must be at least $param chars.";
                break;
            case 'max':
                if ($value !== null && strlen((string) $value) > (int) $param) $this->errors[$field][] = "$field must be at most $param chars.";
                break;
            case 'numeric':
                if ($value !== null && !is_numeric($value)) $this->errors[$field][] = "$field must be numeric.";
                break;
            case 'date':
                if ($value && !strtotime((string) $value)) $this->errors[$field][] = "$field must be a valid date.";
                break;
        }
    }

    public function errors(): array { return $this->errors; }
    public function fails(): bool { return !empty($this->errors); }
}
