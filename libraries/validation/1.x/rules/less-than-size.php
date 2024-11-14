<?php

return export(default: function (object $context, float|int $compare): ?string {
    assert(import('../context')->type()->assert($context));

    $size = import('shared/size')($context->value);

    if (is_null($size) || $size >= $compare) {
        return 'validation.less-than-size';
    }

    return null;
});
