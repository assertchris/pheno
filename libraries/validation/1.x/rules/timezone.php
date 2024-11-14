<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! in_array((string) $context->value, DateTimeZone::listIdentifiers())) {
        return 'validation.timezone';
    }

    return null;
});
