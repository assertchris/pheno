<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    $pattern = '/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/';

    if (! preg_match($pattern, $context->value)) {
        return 'validation.mac-address';
    }

    return null;
});
