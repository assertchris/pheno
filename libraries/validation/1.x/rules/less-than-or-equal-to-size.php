<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (import('less-than-size')(context: $context, compare: $compare)
        && import('size')(context: $context, compare: $compare)) {
        return 'validation.less-than-or-equal-to-size';
    }

    return null;
});
