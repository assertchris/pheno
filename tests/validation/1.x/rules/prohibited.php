<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $prohibited = import('b/validation/1.x/rules/prohibited');
    $countable = import('shared/countable');

    // 1. Valid cases (fields are empty or missing)
    $assert($prohibited($context(field: 'prohibited', value: null)) == null);
    $assert($prohibited($context(field: 'prohibited', value: '')) == null);
    $assert($prohibited($context(field: 'prohibited', value: [])) == null);
    $assert($prohibited($context(field: 'prohibited', value: $countable())) == null);

    // 2. Invalid cases (fields are not empty)
    $assert($prohibited($context(field: 'prohibited', value: 'some value')) == 'validation.prohibited');
    $assert($prohibited($context(field: 'prohibited', value: [1, 2, 3])) == 'validation.prohibited');
    $assert($prohibited($context(field: 'prohibited', value: $countable([1]))) == 'validation.prohibited');
});
