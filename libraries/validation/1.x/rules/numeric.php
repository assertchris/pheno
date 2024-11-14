<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! is_numeric($context->value)) {
        return 'validation.numeric';
    }

    return null;
});
