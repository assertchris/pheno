<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $confirmed = import('b/validation/1.x/rules/confirmed');

    // 1. valid cases: confirmation matches the original value
    $assert($confirmed($context(field: 'password', value: 'password', values: ['password_confirmation' => 'password'])) == null);
    $assert($confirmed($context(field: 'email', value: 'example@example.com', values: ['email_confirmation' => 'example@example.com'])) == null);

    // 2. invalid cases: confirmation does not match the original value
    $assert($confirmed($context(field: 'password', value: 'password', values: ['password_confirmation' => 'different'])) == 'validation.confirmed');
    $assert($confirmed($context(field: 'email', value: 'example@example.com', values: ['email_confirmation' => 'different@example.com'])) == 'validation.confirmed');

    // 3. invalid cases: confirmation key does not exist
    $assert($confirmed($context(field: 'username', value: 'user1', values: [])) == 'validation.confirmed');
    $assert($confirmed($context(field: 'address', value: '123 Main St', values: ['address_confirmation' => ''])) == 'validation.confirmed');
});
