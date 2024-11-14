<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    $key = $context->field.'_confirmation';

    if (! isset($context->values[$key]) || !isset($context->value) || $context->values[$key] !== $context->value) {
        return 'validation.confirmed';
    }

    return null;
});
