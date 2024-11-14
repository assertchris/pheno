<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $boolean = import('b/validation/1.x/rules/boolean');

    // 1. valid cases: all acceptable boolean values
    $assert($boolean($context(field: 'boolean', value: true)) == null);
    $assert($boolean($context(field: 'boolean', value: false)) == null);
    $assert($boolean($context(field: 'boolean', value: 1)) == null);
    $assert($boolean($context(field: 'boolean', value: 0)) == null);
    $assert($boolean($context(field: 'boolean', value: '1')) == null);
    $assert($boolean($context(field: 'boolean', value: '0')) == null);

    // 2. invalid cases: values not in the allowed list
    $assert($boolean($context(field: 'boolean', value: null)) == 'validation.boolean');
    $assert($boolean($context(field: 'boolean', value: 'true')) == 'validation.boolean');
    $assert($boolean($context(field: 'boolean', value: 'false')) == 'validation.boolean');
    $assert($boolean($context(field: 'boolean', value: 2)) == 'validation.boolean');
    $assert($boolean($context(field: 'boolean', value: -1)) == 'validation.boolean');
    $assert($boolean($context(field: 'boolean', value: 'not a boolean')) == 'validation.boolean');
});
