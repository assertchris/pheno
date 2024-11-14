<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $alphaNumericDash = import('b/validation/1.x/rules/alpha-numeric-dash');

    // 1. valid values (non-ASCII)
    $assert($alphaNumericDash($context(field: 'username', value: 'José_123')) == null);
    $assert($alphaNumericDash($context(field: 'username', value: 'Müller-42')) == null);
    $assert($alphaNumericDash($context(field: 'username', value: 'Élise99_')) == null);

    // 2. valid values (ASCII only)
    $assert($alphaNumericDash($context(field: 'username', value: 'John_123'), ascii: true) == null);
    $assert($alphaNumericDash($context(field: 'username', value: 'Alice-42'), ascii: true) == null);

    // 3. invalid values (non-ASCII with ASCII constraint)
    $assert($alphaNumericDash($context(field: 'username', value: 'José_123'), ascii: true) == 'validation.alpha-numeric-dash');
    $assert($alphaNumericDash($context(field: 'username', value: 'Müller-42'), ascii: true) == 'validation.alpha-numeric-dash');

    // 4. invalid values (any mode)
    $assert($alphaNumericDash($context(field: 'username', value: 'John!23')) == 'validation.alpha-numeric-dash');
    $assert($alphaNumericDash($context(field: 'username', value: 'Alice@42')) == 'validation.alpha-numeric-dash');
    $assert($alphaNumericDash($context(field: 'username', value: 'Élise#99')) == 'validation.alpha-numeric-dash');
    $assert($alphaNumericDash($context(field: 'username', value: '')) == 'validation.alpha-numeric-dash'); // assuming empty string is invalid
});
