<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $numeric = import('b/validation/1.x/rules/numeric');

    // 1. Valid cases
    $assert($numeric($context(field: 'numeric', value: 123)) == null);
    $assert($numeric($context(field: 'numeric', value: '456')) == null);
    $assert($numeric($context(field: 'numeric', value: 0.78)) == null);
    $assert($numeric($context(field: 'numeric', value: '-100')) == null);

    // 2. Invalid cases
    $assert($numeric($context(field: 'numeric', value: 'abc')) == 'validation.numeric');
    $assert($numeric($context(field: 'numeric', value: '')) == 'validation.numeric');
    $assert($numeric($context(field: 'numeric', value: '12.34abc')) == 'validation.numeric');
    $assert($numeric($context(field: 'numeric', value: [])) == 'validation.numeric');
});
