<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $multipleOf = import('b/validation/1.x/rules/multiple-of');

    // 1. Valid cases
    $assert($multipleOf($context(field: 'multiple-of', value: 10), value: 5) == null);
    $assert($multipleOf($context(field: 'multiple-of', value: 15), value: 3) == null);
    $assert($multipleOf($context(field: 'multiple-of', value: 0), value: 1) == null);
    $assert($multipleOf($context(field: 'multiple-of', value: -20), value: -5) == null);

    // 2. Invalid cases
    $assert($multipleOf($context(field: 'multiple-of', value: 10), value: 3) == 'validation.multiple-of');
    $assert($multipleOf($context(field: 'multiple-of', value: 7), value: 5) == 'validation.multiple-of');
    $assert($multipleOf($context(field: 'multiple-of', value: 0), value: 0) == 'validation.multiple-of');
});
