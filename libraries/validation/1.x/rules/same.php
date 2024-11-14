<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (! array_key_exists($compare, $context->values)) {
        return 'validation.same';
    }

    if ($context->value !== $context->values[$compare]) {
        return 'validation.same';
    }

    return null;
});
