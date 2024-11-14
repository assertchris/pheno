<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! filter_var(filter_var($context->value, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
        return 'validation.email';
    }

    return null;
});
