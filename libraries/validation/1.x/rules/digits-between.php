<?php

return export(default: function (object $context, int $min, int $max): ?string {
    assert(import('../context')->type()->assert($context));

    $value = (string) abs((int) $context->value);

    // handle edge-case of empty string being turned into 0
    if ($context->value === '') {
        $value = '';
    }

    $length = mb_strlen($value);

    if ($length < $min || $length > $max) {
        return 'validation.digits-between';
    }

    return null;
});
