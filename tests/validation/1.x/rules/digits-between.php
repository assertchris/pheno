<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $digitsBetween = import('b/validation/1.x/rules/digits-between');

    // 1. valid cases: values within the specified length range
    $assert($digitsBetween($context(field: 'digits-between', value: 12345), min: 5, max: 6) == null);
    $assert($digitsBetween($context(field: 'digits-between', value: 123456), min: 5, max: 6) == null);
    $assert($digitsBetween($context(field: 'digits-between', value: -1234), min: 4, max: 5) == null);
    $assert($digitsBetween($context(field: 'digits-between', value: 0), min: 1, max: 1) == null);

    // 2. invalid cases: values outside the specified length range
    $assert($digitsBetween($context(field: 'digits-between', value: 123), min: 5, max: 6) == 'validation.digits-between');
    $assert($digitsBetween($context(field: 'digits-between', value: 1234567), min: 5, max: 6) == 'validation.digits-between');
    $assert($digitsBetween($context(field: 'digits-between', value: -12345678), min: 4, max: 6) == 'validation.digits-between');

    // 3. edge case: empty value
    $assert($digitsBetween($context(field: 'digits-between', value: ''), min: 1, max: 1) == 'validation.digits-between');
    $assert($digitsBetween($context(field: 'digits-between', value: ''), min: 0, max: 1) == null);

    // 4. edge case: non-numeric string value
    $assert($digitsBetween($context(field: 'digits-between', value: 'abc'), min: 3, max: 3) == 'validation.digits-between');
});
