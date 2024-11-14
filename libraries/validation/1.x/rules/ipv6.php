<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (filter_var($context->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
        return 'validation.ipv6';
    }

    return null;
});
