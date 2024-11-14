<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $regex = import('b/validation/1.x/rules/regex');

    // 1. valid cases: values that match the regex pattern
    $assert($regex($context(field: 'regex', value: 'abc123'), pattern: '/^[a-z0-9]+$/') == null);
    $assert($regex($context(field: 'regex', value: 'test@example.com'), pattern: '/^.+@.+\..+$/') == null);
    $assert($regex($context(field: 'regex', value: '12345'), pattern: '/^\d+$/') == null);

    // 2. invalid cases: values that don't match the regex pattern
    $assert($regex($context(field: 'regex', value: 'ABC123'), pattern: '/^[a-z0-9]+$/') == 'validation.regex');
    $assert($regex($context(field: 'regex', value: 'invalid-email'), pattern: '/^.+@.+\..+$/') == 'validation.regex');
    $assert($regex($context(field: 'regex', value: '12a45'), pattern: '/^\d+$/') == 'validation.regex');

    // 3. edge case: empty value
    $assert($regex($context(field: 'regex', value: ''), pattern: '/^[a-z0-9]+$/') == 'validation.regex');

    // 4. edge case: complex pattern
    $assert($regex($context(field: 'regex', value: 'A1b2C3'), pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/') == null);
    $assert($regex($context(field: 'regex', value: 'abc123'), pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/') == 'validation.regex');
});
