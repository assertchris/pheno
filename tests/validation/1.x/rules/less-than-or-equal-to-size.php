<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $lessThanOrEqualToSize = import('b/validation/1.x/rules/less-than-or-equal-to-size');

    // 1. valid cases: sizes that are less than or equal to the comparison value
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: 'abc'), compare: 3) == null);
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: [1, 2]), compare: 2) == null);
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: 5), compare: 5) == null);

    // 2. invalid cases: sizes that are greater than the comparison value
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: 'abcd'), compare: 3) == 'validation.less-than-or-equal-to-size');
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: [1, 2, 3]), compare: 2) == 'validation.less-than-or-equal-to-size');
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: 10), compare: 5) == 'validation.less-than-or-equal-to-size');

    // 3. edge case: null size
    $assert($lessThanOrEqualToSize($context(field: 'less-than-or-equal-to-size', value: null), compare: 1) == 'validation.less-than-or-equal-to-size');
});
