<?php

return export(default: function (object $context, bool $ascii = false): ?string {
    assert(import('../context')->type()->assert($context));

    $pattern = '/^[\p{L}\p{M}\p{N}]+$/u';

    if ($ascii) {
        $pattern = '/^[A-Za-z0-9]+$/u';
    }

    if (! preg_match($pattern, $context->value)) {
        return 'validation.alpha-numeric';
    }

    return null;
});
