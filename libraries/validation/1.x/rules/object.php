<?php

return export(default: function (object $context, array $keys = []): ?string {
    assert(import('../context')->type()->assert($context));

    if (! is_object($context->value)) {
        return 'validation.object';
    }

    foreach ($keys as $key) {
        if (! isset($context->value->$key)) {
            return 'validation.object';
        }
    }

    return null;
});
