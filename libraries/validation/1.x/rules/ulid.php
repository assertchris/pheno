<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! preg_match('/^[0-7][0-9A-HJKMNP-TV-Z]{25}$/', (string) $context->value)) {
        return 'validation.ulid';
    }

    return null;
});
