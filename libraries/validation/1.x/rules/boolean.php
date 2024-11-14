<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    $allowed = [true, false, 1, 0, '1', '0'];

    if (! in_array($context->value, $allowed, strict: true)) {
        return 'validation.boolean';
    }

    return null;
});
