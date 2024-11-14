<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $in = import('b/validation/1.x/rules/in');

    // 1. valid cases: values present in the array
    $assert($in($context(field: 'in', value: 'apple'), values: ['apple', 'banana', 'orange']) == null);
    $assert($in($context(field: 'in', value: 42), values: [42, 13, 7]) == null);
    $assert($in($context(field: 'in', value: 'orange'), values: ['apple', 'banana', 'orange']) == null);

    // 2. invalid cases: values not present in the array
    $assert($in($context(field: 'in', value: 'grape'), values: ['apple', 'banana', 'orange']) == 'validation.in');
    $assert($in($context(field: 'in', value: 10), values: [42, 13, 7]) == 'validation.in');
    $assert($in($context(field: 'in', value: 'pear'), values: ['apple', 'banana']) == 'validation.in');

    // 3. edge case: empty values array
    $assert($in($context(field: 'in', value: 'anything'), values: []) == 'validation.in');
});
