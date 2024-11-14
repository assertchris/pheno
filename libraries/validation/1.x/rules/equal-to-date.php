<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    if (isset($context->values[$compare])) {
        $compare = $context->values[$compare];
    }

    $leftTime = strtotime($context->value);
    $rightTime = strtotime($compare);

    if (! $leftTime || ! $rightTime || $leftTime !== $rightTime) {
        return 'validation.equal-to-date';
    }

    return null;
});
