<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $greaterThanOrEqualToSize = import('b/validation/1.x/rules/greater-than-or-equal-to-size');

    // 1. valid cases: sizes greater than or equal to the comparison value
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: 'This is a valid string.'), compare: 10) == null);
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: 'Exact length.'), compare: 13) == null);
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: '123456'), compare: 6) == null);

    // 2. invalid cases: sizes less than the comparison value
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: 'Short'), compare: 6) == 'validation.greater-than-or-equal-to-size');
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: '1234'), compare: 5) == 'validation.greater-than-or-equal-to-size');

    // 3. edge case: null size
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: null), compare: 5) == 'validation.greater-than-or-equal-to-size');

    // 4. edge case: comparison with negative value
    $assert($greaterThanOrEqualToSize($context(field: 'greater-than-or-equal-to-size', value: 'Any string'), compare: -5) == null);
});
