<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('shared/has-value')($context->value)) {
        return 'validation.prohibited';
    }

    return null;
});
