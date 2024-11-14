<?php

return export(default: function (object $context, int $precision): ?string {
    assert(import('../context')->type()->assert($context));

    $value = $context->value;

    if (! preg_match('/^\d+\.\d{'.$precision.'}$/', $value)) {
        return 'validation.decimal';
    }

    return null;
});
