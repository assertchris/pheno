<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', (string) $context->value)) {
        return 'validation.uuid';
    }

    return null;
});
