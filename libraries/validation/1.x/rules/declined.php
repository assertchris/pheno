<?php

return export(default: function (object $context, array $if = []): ?string {
    assert(import('../context')->type()->assert($context));

    foreach ($if as $field => $expected) {
        if ($context->values[$field] !== $expected) {
            return null;
        }
    }

    $allowed = ['no', 'off', 0, '0', false, 'false'];

    if (! in_array($context->value, $allowed, strict: true)) {
        return 'validation.declined';
    }

    return null;
});
