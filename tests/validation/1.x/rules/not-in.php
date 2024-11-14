<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $notIn = import('b/validation/1.x/rules/not-in');

    $values = ['forbidden', 'restricted', 'banned'];

    // 1. Valid cases
    $assert($notIn($context(field: 'not-in', value: 'allowed'), values: $values) == null);
    $assert($notIn($context(field: 'not-in', value: 'permitted'), values: $values) == null);

    // 2. Invalid cases
    $assert($notIn($context(field: 'not-in', value: 'forbidden'), values: $values) == 'validation.not-in');
    $assert($notIn($context(field: 'not-in', value: 'restricted'), values: $values) == 'validation.not-in');
    $assert($notIn($context(field: 'not-in', value: 'banned'), values: $values) == 'validation.not-in');
});
