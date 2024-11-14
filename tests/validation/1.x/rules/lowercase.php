<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $lowercase = import('b/validation/1.x/rules/lowercase');

    // 1. valid cases: all lowercase strings
    $assert($lowercase($context(field: 'lowercase', value: 'abcde')) == null);
    $assert($lowercase($context(field: 'lowercase', value: 'hello world')) == null);
    $assert($lowercase($context(field: 'lowercase', value: 'test123')) == null);
    $assert($lowercase($context(field: 'lowercase', value: 'lowercase_string')) == null);

    // 2. invalid cases: strings with uppercase letters
    $assert($lowercase($context(field: 'lowercase', value: 'Abcde')) == 'validation.lowercase');
    $assert($lowercase($context(field: 'lowercase', value: 'Hello World')) == 'validation.lowercase');
    $assert($lowercase($context(field: 'lowercase', value: '123ABC')) == 'validation.lowercase');
    $assert($lowercase($context(field: 'lowercase', value: 'test@ABC')) == 'validation.lowercase');

    // 3. edge case: empty string
    $assert($lowercase($context(field: 'lowercase', value: '')) == null);
});
