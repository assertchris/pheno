<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! preg_match('/^[\x00-\x7F]+$/', $context->value)) {
        return 'validation.ascii';
    }

    return null;
});
