<?php

return export(default: function () {
    $attempt = import('b/support/1.x/attempt');
    $string = import('b/support/1.x/type/string');

    assert($string()->assert('hello world') == 'hello world');

    [$exception] = $attempt(fn () => $string()->assert(123));
    assert($exception::name == 'support/type/invalid-type');
    assert($exception->getMessage() == "'123' is not string");

    [$exception] = $attempt(fn () => $string()->min(3)->assert('ab'));
    assert($exception::name == 'support/type/too-small');
    assert($exception->getMessage() == "'ab' is smaller than 3");

    [$exception] = $attempt(fn () => $string()->max(1)->assert("ab"));
    assert($exception::name == 'support/type/too-big');
    assert($exception->getMessage() == "'ab' is bigger than 1");

    [$exception] = $attempt(fn () => $string()->options(['hello', 'world'])->assert("chris"));
    assert($exception::name == 'support/type/invalid-option');
    assert($exception->getMessage() == "'chris' is not in the list ['hello', 'world']");
});
