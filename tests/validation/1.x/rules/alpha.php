<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $alpha = import('b/validation/1.x/rules/alpha');

    // 1. valid values (non-ASCII)
    $assert($alpha($context(field: 'name', value: 'José')) == null);
    $assert($alpha($context(field: 'name', value: 'Müller')) == null);
    $assert($alpha($context(field: 'name', value: 'Élise')) == null);

    // 2. valid values (ASCII only)
    $assert($alpha($context(field: 'name', value: 'John'), ascii: true) == null);
    $assert($alpha($context(field: 'name', value: 'Alice'), ascii: true) == null);

    // 3. invalid values (non-ASCII with ASCII constraint)
    $assert($alpha($context(field: 'name', value: 'José'), ascii: true) == 'validation.alpha');
    $assert($alpha($context(field: 'name', value: 'Müller'), ascii: true) == 'validation.alpha');

    // 4. invalid values (any mode)
    $assert($alpha($context(field: 'name', value: 'John123')) == 'validation.alpha');
    $assert($alpha($context(field: 'name', value: 'Alice@')) == 'validation.alpha');
    $assert($alpha($context(field: 'name', value: 'Élise123')) == 'validation.alpha');
    $assert($alpha($context(field: 'name', value: '')) == 'validation.alpha'); // assuming empty string is invalid
});
