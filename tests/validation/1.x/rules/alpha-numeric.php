<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $alphaNumeric = import('b/validation/1.x/rules/alpha-numeric');

    // 1. valid values (non-ASCII)
    $assert($alphaNumeric($context(field: 'username', value: 'José123')) == null);
    $assert($alphaNumeric($context(field: 'username', value: 'Müller42')) == null);
    $assert($alphaNumeric($context(field: 'username', value: 'Élise99')) == null);

    // 2. valid values (ASCII only)
    $assert($alphaNumeric($context(field: 'username', value: 'John123'), ascii: true) == null);
    $assert($alphaNumeric($context(field: 'username', value: 'Alice42'), ascii: true) == null);

    // 3. invalid values (non-ASCII with ASCII constraint)
    $assert($alphaNumeric($context(field: 'username', value: 'José123'), ascii: true) == 'validation.alpha-numeric');
    $assert($alphaNumeric($context(field: 'username', value: 'Müller42'), ascii: true) == 'validation.alpha-numeric');

    // 4. invalid values (any mode)
    $assert($alphaNumeric($context(field: 'username', value: 'John!23')) == 'validation.alpha-numeric');
    $assert($alphaNumeric($context(field: 'username', value: 'Alice@42')) == 'validation.alpha-numeric');
    $assert($alphaNumeric($context(field: 'username', value: 'Élise#99')) == 'validation.alpha-numeric');
    $assert($alphaNumeric($context(field: 'username', value: '')) == 'validation.alpha-numeric'); // assuming empty string is invalid
});
