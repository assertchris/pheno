<?php

return export(default: function (object $context, bool $ascii = false): ?string {
    assert(import('../context')->type()->assert($context));

    $pattern = '/^[\p{L}\p{M}]+$/u';

    if ($ascii) {
        $pattern = '/^[A-Za-z]+$/u';
    }

    if (! preg_match($pattern, $context->value)) {
        return 'validation.alpha';
    }

    return null;
});
