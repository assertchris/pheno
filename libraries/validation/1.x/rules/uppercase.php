<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    $value = $context->value;

    if ($value !== strtoupper((string) $value)) {
        return 'validation.uppercase';
    }

    return null;
});
