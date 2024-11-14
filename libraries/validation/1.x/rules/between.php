<?php

return export(default: function (object $context, float|int $min, float|int $max): ?string {
    assert(import('../context')->type()->assert($context));

    $size = import('shared/size')($context->value);

    if (is_null($size) || $size < $min || $size > $max) {
        return 'validation.between';
    }

    return null;
});
