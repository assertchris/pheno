<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $ascii = import('b/validation/1.x/rules/ascii');

    // 1. valid ASCII values
    $assert($ascii($context(field: 'text', value: 'Hello')) == null);
    $assert($ascii($context(field: 'text', value: '1234')) == null);
    $assert($ascii($context(field: 'text', value: '!@#$%^&*()_+')) == null);
    $assert($ascii($context(field: 'text', value: 'Hello123')) == null);
    $assert($ascii($context(field: 'text', value: ' ')) == null); // space is valid ASCII

    // 2. invalid values (non-ASCII characters)
    $assert($ascii($context(field: 'text', value: 'José')) == 'validation.ascii');
    $assert($ascii($context(field: 'text', value: 'Müller')) == 'validation.ascii');
    $assert($ascii($context(field: 'text', value: 'こんにちは')) == 'validation.ascii');
    $assert($ascii($context(field: 'text', value: '你好')) == 'validation.ascii');
    $assert($ascii($context(field: 'text', value: '🙂')) == 'validation.ascii'); // emoji
});
