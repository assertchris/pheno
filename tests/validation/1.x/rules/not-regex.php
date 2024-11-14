<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $notRegex = import('b/validation/1.x/rules/not-regex');

    $pattern = '/^abc/';

    // 1. Valid cases
    $assert($notRegex($context(field: 'not-regex', value: 'def'), pattern: $pattern) == null);
    $assert($notRegex($context(field: 'not-regex', value: 'xyz'), pattern: $pattern) == null);

    // 2. Invalid cases
    $assert($notRegex($context(field: 'not-regex', value: 'abc123'), pattern: $pattern) == 'validation.not-regex');
    $assert($notRegex($context(field: 'not-regex', value: 'abc'), pattern: $pattern) == 'validation.not-regex');
});
