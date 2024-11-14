<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $greaterThanSize = import('b/validation/1.x/rules/greater-than-size');

    // 1. valid cases: sizes greater than the comparison value
    $assert($greaterThanSize($context(field: 'greater-than-size', value: 'This is a string.'), compare: 10) == null);
    $assert($greaterThanSize($context(field: 'greater-than-size', value: 'Lorem ipsum dolor sit amet.'), compare: 20) == null);
    $assert($greaterThanSize($context(field: 'greater-than-size', value: '1234567890'), compare: 5) == null);

    // 2. invalid cases: sizes less than or equal to the comparison value
    $assert($greaterThanSize($context(field: 'greater-than-size', value: 'Short'), compare: 5) == 'validation.greater-than-size');
    $assert($greaterThanSize($context(field: 'greater-than-size', value: '1234'), compare: 4) == 'validation.greater-than-size');
    $assert($greaterThanSize($context(field: 'greater-than-size', value: ''), compare: 0) == 'validation.greater-than-size');

    // 3. edge case: null size
    $assert($greaterThanSize($context(field: 'greater-than-size', value: null), compare: 5) == 'validation.greater-than-size');

    // 4. edge case: comparison with negative value
    $assert($greaterThanSize($context(field: 'greater-than-size', value: 'Any string'), compare: -5) == null);
});
