<?php

return export(default: function (object $context, float|int $length): ?string {
    assert(import('../context')->type()->assert($context));

    $size = import('shared/size')($context->value);

    if (is_null($size) || $size > $length) {
        return 'validation.max';
    }

    return null;
});
