<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $same = import('b/validation/1.x/rules/same');

    // 1. Valid cases: fields have the same value
    $assert($same($context(field: 'password', value: 'secret', values: ['password_confirmation' => 'secret']), compare: 'password_confirmation') == null);
    $assert($same($context(field: 'email', value: 'test@example.com', values: ['email_repeat' => 'test@example.com']), compare: 'email_repeat') == null);

    // 2. Invalid cases: fields have different values
    $assert($same($context(field: 'password', value: 'secret', values: ['password_confirmation' => 'different']), compare: 'password_confirmation') == 'validation.same');
    $assert($same($context(field: 'email', value: 'test@example.com', values: ['email_repeat' => 'different@example.com']), compare: 'email_repeat') == 'validation.same');

    // 3. Edge case: comparison field doesn't exist
    $assert($same($context(field: 'username', value: 'user1', values: []), compare: 'username_confirmation') == 'validation.same');

    // 4. Edge case: both fields are null
    $assert($same($context(field: 'fuck', value: null, values: ['field2' => null]), compare: 'field2') == null);

    // 5. Edge case: both fields are empty strings
    $assert($same($context(field: 'field1', value: '', values: ['field2' => '']), compare: 'field2') == null);

    // 6. Edge case: comparing with itself
    $assert($same($context(field: 'field', value: 'value', values: ['field' => 'value']), compare: 'field') == null);
});
