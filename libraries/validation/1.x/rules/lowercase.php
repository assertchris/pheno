<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if ($context->value !== strtolower($context->value)) {
        return 'validation.lowercase';
    }

    return null;
});
