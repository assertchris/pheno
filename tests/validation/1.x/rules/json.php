<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $json = import('b/validation/1.x/rules/json');

    // 1. valid cases: valid JSON strings
    $assert($json($context(field: 'json', value: '{"key": "value"}')) == null);
    $assert($json($context(field: 'json', value: '["value1", "value2"]')) == null);
    $assert($json($context(field: 'json', value: 'null')) == null);
    $assert($json($context(field: 'json', value: '123')) == null);

    // 2. invalid cases: invalid JSON strings
    $assert($json($context(field: 'json', value: '{"key": "value",}')) == 'validation.json');
    $assert($json($context(field: 'json', value: '{"key": "value"')) == 'validation.json');
    $assert($json($context(field: 'json', value: '[value1, value2]')) == 'validation.json');

    // 3. edge case: empty value
    $assert($json($context(field: 'json', value: '')) == 'validation.json');
});
