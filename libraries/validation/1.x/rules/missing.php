<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (array_key_exists($context->field, $context->values)) {
        return 'validation.missing';
    }

    return null;
});
