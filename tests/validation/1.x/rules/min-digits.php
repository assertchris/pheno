<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $minDigits = import('b/validation/1.x/rules/min-digits');

    // 1. Valid cases
    $assert($minDigits($context(field: 'min-digits', value: 123), length: 2) == null);
    $assert($minDigits($context(field: 'min-digits', value: -99), length: 2) == null);
    $assert($minDigits($context(field: 'min-digits', value: 0), length: 1) == null);
    $assert($minDigits($context(field: 'min-digits', value: 1000), length: 3) == null);
    $assert($minDigits($context(field: 'min-digits', value: ''), length: 0) == null);

    // 2. Invalid cases
    $assert($minDigits($context(field: 'min-digits', value: 1), length: 2) == 'validation.min-digits');
    $assert($minDigits($context(field: 'min-digits', value: -1), length: 2) == 'validation.min-digits');
    $assert($minDigits($context(field: 'min-digits', value: 99), length: 3) == 'validation.min-digits');
    $assert($minDigits($context(field: 'min-digits', value: ''), length: 3) == 'validation.min-digits');
});
