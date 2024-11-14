<?php

return export(default: function (object $context, array $keys): ?string {
    assert(import('../context')->type()->assert($context));

    if (! is_array($context->value)) {
        return 'validation.required-keys';
    }

    foreach ($keys as $key) {
        if (! array_key_exists($key, $context->value)) {
            return 'validation.required-keys';
        }
    }

    return null;
});
