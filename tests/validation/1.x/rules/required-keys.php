<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $requiredKeys = import('b/validation/1.x/rules/required-keys');

    // 1. valid cases: array with all required keys
    $assert($requiredKeys($context(field: 'required-keys', value: ['key1' => 'value1', 'key2' => 'value2']), keys: ['key1', 'key2']) == null);
    $assert($requiredKeys($context(field: 'required-keys', value: ['key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3']), keys: ['key1', 'key2']) == null);

    // 2. invalid cases: missing required keys
    $assert($requiredKeys($context(field: 'required-keys', value: ['key1' => 'value1']), keys: ['key1', 'key2']) == 'validation.required-keys');
    $assert($requiredKeys($context(field: 'required-keys', value: []), keys: ['key1']) == 'validation.required-keys');

    // 3. invalid cases: not an array
    $assert($requiredKeys($context(field: 'required-keys', value: 'not an array'), keys: ['key1']) == 'validation.required-keys');
    $assert($requiredKeys($context(field: 'required-keys', value: 123), keys: ['key1']) == 'validation.required-keys');
    $assert($requiredKeys($context(field: 'required-keys', value: null), keys: ['key1']) == 'validation.required-keys');
});
