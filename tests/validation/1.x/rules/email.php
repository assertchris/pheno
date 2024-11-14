<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $email = import('b/validation/1.x/rules/email');

    // 1. valid cases: valid email addresses
    $assert($email($context(field: 'email', value: 'test@example.com')) == null);
    $assert($email($context(field: 'email', value: 'user.name+tag+sorting@example.com')) == null);
    $assert($email($context(field: 'email', value: 'user@example.co.uk')) == null);
    $assert($email($context(field: 'email', value: 'user@subdomain.example.com')) == null);

    // 2. invalid cases: invalid email addresses
    $assert($email($context(field: 'email', value: 'plainaddress')) == 'validation.email');
    $assert($email($context(field: 'email', value: '@missingusername.com')) == 'validation.email');
    $assert($email($context(field: 'email', value: 'username@.com')) == 'validation.email');
    $assert($email($context(field: 'email', value: 'username@domain..com')) == 'validation.email');
    $assert($email($context(field: 'email', value: 'username@domain.com.')) == 'validation.email');

    // 3. edge case: empty value
    $assert($email($context(field: 'email', value: '')) == 'validation.email');

    // 4. edge case: non-email strings
    $assert($email($context(field: 'email', value: 'not_an_email')) == 'validation.email');
    $assert($email($context(field: 'email', value: 'user@domain..com')) == 'validation.email');
});
