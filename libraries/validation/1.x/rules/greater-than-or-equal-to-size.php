<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('greater-than-size')(context: $context, compare: $compare)
        && import('size')(context: $context, compare: $compare)) {
        return 'validation.greater-than-or-equal-to-size';
    }

    return null;
});
