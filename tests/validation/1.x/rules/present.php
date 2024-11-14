<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $present = import('b/validation/1.x/rules/present');

    $valid = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'age' => 30,
    ];

    // 1. Valid cases
    $assert($present($context(field: 'name', values: $valid)) == null);
    $assert($present($context(field: 'email', values: $valid)) == null);
    $assert($present($context(field: 'age', values: $valid)) == null);

    // 2. Invalid cases
    $assert($present($context(field: 'address', values: $valid)) == 'validation.present');
    $assert($present($context(field: 'phone', values: $valid)) == 'validation.present');
});
