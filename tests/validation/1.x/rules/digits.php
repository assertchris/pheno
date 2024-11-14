<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $digits = import('b/validation/1.x/rules/digits');

    // 1. valid cases: values with exact specified length
    $assert($digits($context(field: 'digits', value: 123456), length: 6) == null);
    $assert($digits($context(field: 'digits', value: -12345), length: 5) == null);
    $assert($digits($context(field: 'digits', value: 0), length: 1) == null);

    // 2. invalid cases: values with different lengths
    $assert($digits($context(field: 'digits', value: 123), length: 5) == 'validation.digits');
    $assert($digits($context(field: 'digits', value: -1234), length: 6) == 'validation.digits');
    $assert($digits($context(field: 'digits', value: 1234567), length: 6) == 'validation.digits');

    // 3. edge case: empty value
    $assert($digits($context(field: 'digits', value: ''), length: 0) == null);
    $assert($digits($context(field: 'digits', value: ''), length: 1) == 'validation.digits');

    // 4. edge case: non-numeric string value
    $assert($digits($context(field: 'digits', value: 'abc'), length: 3) == 'validation.digits');
});
