<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! preg_match('/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/', $context->value)) {
        return 'validation.hex-color';
    }

    return null;
});
