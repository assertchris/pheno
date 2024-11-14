<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $integer = import('b/validation/1.x/rules/integer');

    // 1. valid cases: valid integers
    $assert($integer($context(field: 'integer', value: 42)) == null);
    $assert($integer($context(field: 'integer', value: -1)) == null);
    $assert($integer($context(field: 'integer', value: 0)) == null);
    $assert($integer($context(field: 'integer', value: '123')) == null);
    $assert($integer($context(field: 'integer', value: '-456')) == null);

    // 2. invalid cases: non-integer values
    $assert($integer($context(field: 'integer', value: 42.5)) == 'validation.integer');
    $assert($integer($context(field: 'integer', value: 'abc')) == 'validation.integer');
    $assert($integer($context(field: 'integer', value: '12.34')) == 'validation.integer');
    $assert($integer($context(field: 'integer', value: '1.0')) == 'validation.integer');
    $assert($integer($context(field: 'integer', value: null)) == 'validation.integer');
});
