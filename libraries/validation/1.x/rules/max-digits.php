<?php

return export(default: function (object $context, int $length): ?string {
    assert(import('../context')->type()->assert($context));

    $value = (string) abs((int) $context->value);

    // handle edge-case of empty string being turned into 0
    if ($context->value === '') {
        $value = '';
    }

    if (mb_strlen($value) > $length) {
        return 'validation.max-digits';
    }

    return null;
});
