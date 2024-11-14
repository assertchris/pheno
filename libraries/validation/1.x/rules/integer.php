<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    $value = $context->value;

    if (! is_int($value) && (string) (int) (string) $value !== (string) $value) {
        return 'validation.integer';
    }

    return null;
});
