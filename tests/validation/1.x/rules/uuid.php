<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $uuid = import('b/validation/1.x/rules/uuid');

    // 1. Valid cases: valid UUIDs
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-12d3-a456-426614174000')) == null);
    $assert($uuid($context(field: 'uuid', value: 'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11')) == null);

    // 2. Invalid cases: non-UUID strings
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-12d3-a456-42661417400')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-12d3-a456-4266141740000')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-02d3-a456-426614174000')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-12d3-c456-426614174000')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '123e4567e89b12d3a456426614174000')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '123e4567-e89b-12d3-a456-42661417400g')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: '00000000-0000-0000-0000-000000000000')) == 'validation.uuid');

    // 3. Edge cases
    // $assert($uuid($context(field: 'uuid', value: '')) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: null)) == 'validation.uuid');
    $assert($uuid($context(field: 'uuid', value: 123)) == 'validation.uuid');
});
