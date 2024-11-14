<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $uppercase = import('b/validation/1.x/rules/uppercase');

    // 1. Valid cases: uppercase strings
    $assert($uppercase($context(field: 'uppercase', value: 'HELLO')) == null);
    $assert($uppercase($context(field: 'uppercase', value: 'HELLO WORLD')) == null);
    $assert($uppercase($context(field: 'uppercase', value: 'HELLO123')) == null);
    $assert($uppercase($context(field: 'uppercase', value: 'HELLO!@#')) == null);

    // 2. Invalid cases: strings with lowercase characters
    $assert($uppercase($context(field: 'uppercase', value: 'Hello')) == 'validation.uppercase');
    $assert($uppercase($context(field: 'uppercase', value: 'HELLO world')) == 'validation.uppercase');
    $assert($uppercase($context(field: 'uppercase', value: 'hello123')) == 'validation.uppercase');

    // 3. Edge cases
    $assert($uppercase($context(field: 'uppercase', value: '')) == null);
    $assert($uppercase($context(field: 'uppercase', value: '123')) == null);
    $assert($uppercase($context(field: 'uppercase', value: '!@#')) == null);
    $assert($uppercase($context(field: 'uppercase', value: null)) == 'validation.uppercase');
    $assert($uppercase($context(field: 'uppercase', value: 123)) == 'validation.uppercase');
});
