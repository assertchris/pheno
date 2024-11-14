<?php

return export(default: function ($assert) {
    $attempt = import('b/support/1.x/attempt');
    $list = import('b/support/1.x/type/list');
    $string = import('b/support/1.x/type/string');

    $list(
        key: $string(),
        value: $string(),
    )->assert([
        'name' => 'Chris',
    ]);

    [$error] = $attempt(fn () => $list(
        key: $string(),
        value: $string(),
    )->assert([
        'Chris',
    ]));

    $assert($error::name === 'support/type/invalid-type');
    $assert($error->getMessage() === "'0' is not string");
});
