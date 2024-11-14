<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('ipv4')(context: $context)
        && import('ipv6')(context: $context)) {
        return 'validation.ip';
    }

    return null;
});
