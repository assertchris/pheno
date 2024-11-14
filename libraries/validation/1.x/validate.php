<?php

$named = [];

$rules = [
    'accepted',
    'afterDate' => 'after-date',
    'afterOrEqualToDate' => 'after-or-equal-to-date',
    'alpha',
    'alphaNumeric' => 'alpha-numeric',
    'alphaNumericDash' => 'alpha-numeric-dash',
    'array',
    'ascii',
    'beforeDate' => 'before-date',
    'beforeOrEqualToDate' => 'before-or-equal-to-date',
    'between',
    'boolean',
    'confirmed',
    'date',
    'decimal',
    'declined',
    'different',
    'digits',
    'digitsBetween' => 'digits-between',
    'email',
    'endsWith' => 'ends-with',
    'endsWithout' => 'ends-without',
    'equalToDate' => 'equal-to-date',
    'greaterThanOrEqualToSize' => 'greater-than-or-equal-to-size',
    'greaterThanSize' => 'greater-than-size',
    'hexColor' => 'hex-color',
    'in',
    'integer',
    'ip',
    'ipv4',
    'ipv6',
    'json',
    'lessThanOrEqualToSize' => 'less-than-or-equal-to-size',
    'lessThanSize' => 'less-than-size',
    'lowercase',
    'macAddress' => 'mac-address',
    'max',
    'maxDigits' => 'max-digits',
    'min',
    'minDigits' => 'min-digits',
    'missing',
    'multipleOf' => 'multiple-of',
    'notIn' => 'not-in',
    'notRegex' => 'not-regex',
    'numeric',
    'object',
    'present',
    'prohibited',
    'prohibits',
    'regex',
    'required',
    'requiredKeys' => 'required-keys',
    'same',
    'size',
    'startsWith' => 'starts-with',
    'startsWithout' => 'starts-without',
    'string',
    'timezone',
    'ulid',
    'uppercase',
    'url',
    'uuid',
];

foreach ($rules as $key => $rule) {
    if (is_string($key)) {
        $named[$key] = import('rules/'.$rule);
    } else {
        $named[$rule] = import('rules/'.$rule);
    }
}

return export(
    default: function (array $rules, array $values) {
        $data = [];
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            if (! is_array($fieldRules)) {
                $fieldRules = [$fieldRules];
            }

            $context = import('context')(
                field: $field,
                value: $values[$field] ?? null,
                rules: $rules,
                values: $values,
            );

            foreach ($fieldRules as $rule) {
                if ($error = $rule(context: $context)) {
                    if (! isset($errors[$field])) {
                        $errors[$field] = [];
                    }

                    $errors[$field][] = $error;
                }
            }

            if (empty($errors[$field])) {
                $data[$field] = $context->value;
            }
        }

        if (count($errors)) {
            throw import('exceptions/invalid-value')(
                'validation.errors',
                rules: $rules,
                values: $values,
                errors: $errors,
            );
        }

        return $data;
    },
    named: $named,
);
