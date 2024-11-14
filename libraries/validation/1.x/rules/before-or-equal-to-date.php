<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('before-date')(context: $context, compare: $compare)
        && import('equal-to-date')(context: $context, compare: $compare)) {
        return 'validation.before-or-equal-to-date';
    }

    return null;
});
