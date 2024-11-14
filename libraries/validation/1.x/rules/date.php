<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! strtotime($context->value)) {
        return 'validation.date';
    }

    return null;
});
