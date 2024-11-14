<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $between = import('b/validation/1.x/rules/between');

    // 1. valid cases: size is within the range
    $assert($between($context(field: 'between', value: 'abc'), min: 1, max: 5) == null);
    $assert($between($context(field: 'between', value: '12345'), min: 1, max: 10) == null);
    $assert($between($context(field: 'between', value: 'test'), min: 2, max: 4) == null);

    // 2. valid cases: size is equal to min and max
    $assert($between($context(field: 'between', value: 'a'), min: 1, max: 1) == null);
    $assert($between($context(field: 'between', value: 'abcde'), min: 5, max: 5) == null);

    // 3. invalid cases: size is below the minimum
    $assert($between($context(field: 'between', value: ''), min: 1, max: 5) == 'validation.between');
    $assert($between($context(field: 'between', value: 'ab'), min: 3, max: 5) == 'validation.between');

    // 4. invalid cases: size is above the maximum
    $assert($between($context(field: 'between', value: 'abcdef'), min: 1, max: 5) == 'validation.between');
    $assert($between($context(field: 'between', value: '1234567890'), min: 5, max: 9) == 'validation.between');

    // 5. invalid case: null value for size
    $assert($between($context(field: 'between', value: null), min: 1, max: 5) == 'validation.between');

    // 6. testing with different types (floats and integers)
    $assert($between($context(field: 'between', value: 12.34), min: 10.0, max: 13.0) == null);
    $assert($between($context(field: 'between', value: 100), min: 50, max: 150) == null);
});
