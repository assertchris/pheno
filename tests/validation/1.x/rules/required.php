<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $required = import('b/validation/1.x/rules/required');
    $countable = import('shared/countable')();

    // 1. Valid cases: non-empty values
    $assert($required($context(field: 'required', value: 'some value', values: ['required' => 'some value'])) == null);
    $assert($required($context(field: 'required', value: 0, values: ['required' => 0])) == null);
    $assert($required($context(field: 'required', value: false, values: ['required' => false])) == null);
    $assert($required($context(field: 'required', value: [1, 2, 3], values: ['required' => [1, 2, 3]])) == null);

    // 2. Invalid cases: empty or missing values
    $assert($required($context(field: 'required', value: null, values: ['required' => null])) == 'validation.required');
    $assert($required($context(field: 'required', value: '', values: ['required' => ''])) == 'validation.required');
    $assert($required($context(field: 'required', value: [], values: ['required' => []])) == 'validation.required');
    $assert($required($context(field: 'required', value: null, values: [])) == 'validation.required');

    // 3. Edge cases
    $assert($required($context(field: 'required', value: $countable, values: ['required' => $countable])) == 'validation.required');
});
