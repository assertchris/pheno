<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (! isset($context->values[$compare]) || (isset($context->value) && $context->values[$compare] === $context->value)) {
        return 'validation.different';
    }

    return null;
});
