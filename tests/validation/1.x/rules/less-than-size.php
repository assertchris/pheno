<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $lessThanSize = import('b/validation/1.x/rules/less-than-size');

    // 1. valid cases: values with size less than the comparison value
    $assert($lessThanSize($context(field: 'less-than-size', value: 'abc'), compare: 4) == null);
    $assert($lessThanSize($context(field: 'less-than-size', value: [1, 2]), compare: 3) == null);
    $assert($lessThanSize($context(field: 'less-than-size', value: 5), compare: 10) == null);

    // 2. invalid cases: values with size equal to or greater than the comparison value
    $assert($lessThanSize($context(field: 'less-than-size', value: 'abcd'), compare: 4) == 'validation.less-than-size');
    $assert($lessThanSize($context(field: 'less-than-size', value: [1, 2, 3]), compare: 3) == 'validation.less-than-size');
    $assert($lessThanSize($context(field: 'less-than-size', value: 10), compare: 10) == 'validation.less-than-size');

    // 3. edge case: null size
    $assert($lessThanSize($context(field: 'less-than-size', value: null), compare: 1) == 'validation.less-than-size');
});
