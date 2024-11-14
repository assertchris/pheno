<?php

return export(default: function (object $context, array $values = []): ?string {
    assert(import('../context')->type()->assert($context));

    if (! in_array($context->value, $values)) {
        return 'validation.in';
    }

    return null;
});
