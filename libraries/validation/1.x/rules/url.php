<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (filter_var($context->value, FILTER_VALIDATE_URL) === false) {
        return 'validation.url';
    }

    return null;
});
