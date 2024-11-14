<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $maxDigits = import('b/validation/1.x/rules/max-digits');

    // 1. Valid cases
    $assert($maxDigits($context(field: 'max-digits', value: 123), length: 3) == null);
    $assert($maxDigits($context(field: 'max-digits', value: -99), length: 3) == null);
    $assert($maxDigits($context(field: 'max-digits', value: 0), length: 1) == null);
    $assert($maxDigits($context(field: 'max-digits', value: 1000), length: 4) == null);
    $assert($maxDigits($context(field: 'max-digits', value: ''), length: 3) == null);
    $assert($maxDigits($context(field: 'max-digits', value: ''), length: 0) == null);

    // 2. Invalid cases
    $assert($maxDigits($context(field: 'max-digits', value: 12345), length: 4) == 'validation.max-digits');
    $assert($maxDigits($context(field: 'max-digits', value: -10000), length: 4) == 'validation.max-digits');
    $assert($maxDigits($context(field: 'max-digits', value: 999999), length: 5) == 'validation.max-digits');
});
