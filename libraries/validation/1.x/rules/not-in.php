<?php

return export(default: function (object $context, array $values, bool $strict = true): ?string {
    assert(import('../context')->type()->assert($context));

    if (in_array($context->value, $values, $strict)) {
        return 'validation.not-in';
    }

    return null;
});
