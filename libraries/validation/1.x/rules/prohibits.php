<?php

return export(default: function (object $context, string $compare): ?string {
    assert(import('../context')->type()->assert($context));

    $hasValue = import('shared/has-value');

    if ($hasValue($context->value)) {
        if (isset($context->values[$compare])) {
            if ($hasValue($context->values[$compare])) {
                return 'validation.prohibits';
            }
        }
    }

    return null;
});
