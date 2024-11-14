<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $different = import('b/validation/1.x/rules/different');

    // 1. valid case: values are different
    $assert($different($context(field: 'password', value: 'password', values: ['password_confirmation' => 'different']), compare: 'password_confirmation') == null);

    // 2. invalid case: values are the same
    $assert($different($context(field: 'password', value: 'password', values: ['password_confirmation' => 'password']), compare: 'password_confirmation') == 'validation.different');

    // 3. invalid case: comparing to a non-existing field
    $assert($different($context(field: 'username', value: 'user', values: []), compare: 'username_confirmation') == 'validation.different');

    // 4. edge case: both values are empty
    $assert($different($context(field: 'email', value: '', values: ['email_confirmation' => '']), compare: 'email_confirmation') == 'validation.different');

    // 5. edge case: value is null, comparing to existing field
    $assert($different($context(field: 'address', value: null, values: ['address_confirmation' => 'some address']), compare: 'address_confirmation') == null);
    $assert($different($context(field: 'address', value: 'some address', values: ['address_confirmation' => null]), compare: 'address_confirmation') == 'validation.different');
});
