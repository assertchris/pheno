<?php

return export(default: function (object $context, array $if = []): ?string {
    assert(import('../context')->type()->assert($context));

    foreach ($if as $field => $expected) {
        if ($context->values[$field] !== $expected) {
            return null;
        }
    }

    $allowed = ['yes', 'on', 1, '1', true, 'true'];

    if (! in_array($context->value, $allowed, strict: true)) {
        return 'validation.accepted';
    }

    return null;
});
