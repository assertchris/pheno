<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $startsWithout = import('b/validation/1.x/rules/starts-without');

    // 1. valid cases (value does not start with any of the specified endings)
    $assert($startsWithout($context(field: 'starts-without', value: 'hello world'), endings: ['bye', 'world']) == null);
    $assert($startsWithout($context(field: 'starts-without', value: 'example'), endings: ['exx', 'ample', 'test']) == null);
    $assert($startsWithout($context(field: 'starts-without', value: '12345'), endings: ['543', '234']) == null);
    $assert($startsWithout($context(field: 'starts-without', value: 'abcdef'), endings: ['xyz', 'def']) == null);

    // 2. invalid cases (value starts with one of the specified endings)
    $assert($startsWithout($context(field: 'starts-without', value: 'hello world'), endings: ['hello']) == 'validation.starts-without');
    $assert($startsWithout($context(field: 'starts-without', value: 'goodbye'), endings: ['good', 'bye']) == 'validation.starts-without');
    $assert($startsWithout($context(field: 'starts-without', value: '12345'), endings: ['1', '12', '123']) == 'validation.starts-without');
    $assert($startsWithout($context(field: 'starts-without', value: 'abcdef'), endings: ['a', 'ab', 'abc']) == 'validation.starts-without');
});
