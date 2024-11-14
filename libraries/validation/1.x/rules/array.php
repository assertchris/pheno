<?php

return export(default: function (object $context, array $keys = []): ?string {
    assert(import('../context')->type()->assert($context));

    if (! is_array($context->value)) {
        return 'validation.array';
    }

    foreach ($keys as $key) {
        if (! isset($context->value[$key])) {
            return 'validation.array';
        }
    }

    return null;
});
