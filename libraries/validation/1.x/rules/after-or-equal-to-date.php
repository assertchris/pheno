<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('after-date')(context: $context, compare: $compare)
        && import('equal-to-date')(context: $context, compare: $compare)) {
        return 'validation.after-or-equal-to-date';
    }

    return null;
});
