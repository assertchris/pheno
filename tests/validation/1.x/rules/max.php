<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $max = import('b/validation/1.x/rules/max');

    // 1. Valid cases
    $assert($max($context(field: 'max', value: 'abc'), length: 3) == null);
    $assert($max($context(field: 'max', value: [1, 2]), length: 2) == null);
    $assert($max($context(field: 'max', value: 5), length: 5) == null);
    $assert($max($context(field: 'max', value: [1, 2, 3]), length: 3) == null);
    $assert($max($context(field: 'max', value: 'test'), length: 4) == null);

    // 2. Invalid cases
    $assert($max($context(field: 'max', value: 'abcd'), length: 3) == 'validation.max');
    $assert($max($context(field: 'max', value: [1, 2, 3, 4]), length: 3) == 'validation.max');
    $assert($max($context(field: 'max', value: 10), length: 5) == 'validation.max');
});
