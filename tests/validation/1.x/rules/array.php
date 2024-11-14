<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $array = import('b/validation/1.x/rules/array');

    // 1. valid array with no required keys
    $assert($array($context(field: 'array', value: ['a' => 1, 'b' => 2])) == null);

    // 2. valid array with required keys present
    $assert($array($context(field: 'array', value: ['a' => 1, 'b' => 2]), keys: ['a', 'b']) == null);
    $assert($array($context(field: 'array', value: ['a' => 1, 'b' => 2, 'c' => 3]), keys: ['a', 'b']) == null);

    // 3. invalid cases: value is not an array
    $assert($array($context(field: 'array', value: 'not an array')) == 'validation.array');
    $assert($array($context(field: 'array', value: 123)) == 'validation.array');
    $assert($array($context(field: 'array', value: null)) == 'validation.array');

    // 4. invalid cases: missing required keys
    $assert($array($context(field: 'array', value: ['a' => 1]), keys: ['a', 'b']) == 'validation.array');
    $assert($array($context(field: 'array', value: ['a' => 1, 'c' => 3]), keys: ['a', 'b']) == 'validation.array');
    $assert($array($context(field: 'array', value: []), keys: ['a']) == 'validation.array');
});
