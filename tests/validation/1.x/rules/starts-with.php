<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $startsWith = import('b/validation/1.x/rules/starts-with');

    // 1. valid cases (value starts with one of the specified endings)
    $assert($startsWith($context(field: 'starts-with', value: 'hello world'), endings: ['hello']) == null);
    $assert($startsWith($context(field: 'starts-with', value: 'goodbye'), endings: ['good', 'bye']) == null);
    $assert($startsWith($context(field: 'starts-with', value: '12345'), endings: ['1', '12', '123']) == null);
    $assert($startsWith($context(field: 'starts-with', value: 'abcdef'), endings: ['a', 'ab', 'abc']) == null);

    // 2. invalid cases (value does not start with any of the specified endings)
    $assert($startsWith($context(field: 'starts-with', value: 'hello world'), endings: ['bye', 'world']) == 'validation.starts-with');
    $assert($startsWith($context(field: 'starts-with', value: 'example'), endings: ['exx', 'ample', 'test']) == 'validation.starts-with');
    $assert($startsWith($context(field: 'starts-with', value: '12345'), endings: ['543', '234']) == 'validation.starts-with');
    $assert($startsWith($context(field: 'starts-with', value: 'abcdef'), endings: ['xyz', 'def']) == 'validation.starts-with');
});
