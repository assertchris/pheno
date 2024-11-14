<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $object = import('b/validation/1.x/rules/object');

    $valid = (object) [
        'key1' => 'value1',
        'key2' => 'value2',
    ];

    // 1. Valid cases
    $assert($object($context(field: 'object', value: $valid), keys: ['key1', 'key2']) == null);

    // 2. Invalid cases
    $assert($object($context(field: 'object', value: null), keys: []) == 'validation.object');
    $assert($object($context(field: 'object', value: 'string'), keys: []) == 'validation.object');
    $assert($object($context(field: 'object', value: 123), keys: []) == 'validation.object');
    $assert($object($context(field: 'object', value: $valid), keys: ['key1', 'key3']) == 'validation.object');
    $assert($object($context(field: 'object', value: $valid), keys: ['key2', 'key4']) == 'validation.object');
});
