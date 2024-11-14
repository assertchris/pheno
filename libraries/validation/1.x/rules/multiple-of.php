<?php

return export(default: function (object $context, float|int $value): ?string {
    assert(import('../context')->type()->assert($context));

    if ($value === 0 || $context->value % $value !== 0) {
        return 'validation.multiple-of';
    }

    return null;
});
