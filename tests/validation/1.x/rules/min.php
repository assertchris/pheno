<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $min = import('b/validation/1.x/rules/min');

    // 1. Valid cases
    $assert($min($context(field: 'min', value: 5), length: 0) == null);
    $assert($min($context(field: 'min', value: '10'), length: 1) == null);
    $assert($min($context(field: 'min', value: [1, 2, 3]), length: 1) == null);
    $assert($min($context(field: 'min', value: ''), length: 0) == null);

    // 2. Invalid cases
    $assert($min($context(field: 'min', value: 4), length: 5) == 'validation.min');
    $assert($min($context(field: 'min', value: '3'), length: 5) == 'validation.min');
    $assert($min($context(field: 'min', value: []), length: 1) == 'validation.min');
});
