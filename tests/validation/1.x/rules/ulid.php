<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $ulid = import('b/validation/1.x/rules/ulid');

    // 1. Valid cases: correct ULIDs
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FAV')) == null);
    $assert($ulid($context(field: 'ulid', value: '7ZZZZZZZZZZZZZZZZZZZZZZZZZ')) == null);
    $assert($ulid($context(field: 'ulid', value: '00000000000000000000000000')) == null);

    // 2. Invalid cases: incorrect ULIDs
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FA')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FAVV')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '8ARZ3NDEKTSV4RRFFQ69G5FAV')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FAO')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FAU')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FAl')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: '01ARZ3NDEKTSV4RRFFQ69G5FA-')) == 'validation.ulid');

    // 3. Edge cases
    $assert($ulid($context(field: 'ulid', value: '')) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: null)) == 'validation.ulid');
    $assert($ulid($context(field: 'ulid', value: 123)) == 'validation.ulid');
});
