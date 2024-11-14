<?php

return export(default: function (object $context, array $endings): ?string {
    assert(import('../context')->type()->assert($context));

    foreach ($endings as $ending) {
        if (str_ends_with($context->value, $ending)) {
            return null;
        }
    }

    return 'validation.ends-with';
});
