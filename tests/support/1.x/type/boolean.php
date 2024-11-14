<?php

return export(default: function () {
    $attempt = import('b/support/1.x/attempt');
    $boolean = import('b/support/1.x/type/boolean');

    assert($boolean()->assert(true));

    [$exception] = $attempt(fn () => $boolean()->assert(null));
    assert($exception::name == 'support/type/missing-value');
    assert($exception->getMessage() == 'value is missing');

    [$exception] = $attempt(fn () => $boolean()->assert(123));
    assert($exception::name == 'support/type/invalid-type');
    assert($exception->getMessage() == "'123' is not boolean");
});
