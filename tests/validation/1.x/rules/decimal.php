<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $decimal = import('b/validation/1.x/rules/decimal');

    // 1. valid cases: valid decimal numbers with specified precision
    $assert($decimal($context(field: 'decimal', value: '10.00'), precision: 2) == null);
    $assert($decimal($context(field: 'decimal', value: '123.45'), precision: 2) == null);
    $assert($decimal($context(field: 'decimal', value: '0.01'), precision: 2) == null);
    $assert($decimal($context(field: 'decimal', value: '100.000'), precision: 3) == null);
    $assert($decimal($context(field: 'decimal', value: '9.999'), precision: 3) == null);

    // 2. invalid cases: invalid decimal numbers
    $assert($decimal($context(field: 'decimal', value: '10.0'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: '123.456'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: 'abc.def'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: '12.'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: '.99'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: '100'), precision: 2) == 'validation.decimal');
    $assert($decimal($context(field: 'decimal', value: '10.1234'), precision: 2) == 'validation.decimal');
});
