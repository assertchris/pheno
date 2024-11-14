<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! is_string($context->value)) {
        return 'validation.string';
    }

    return null;
});
