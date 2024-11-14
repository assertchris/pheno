<?php

return export(default: function (object $context, string $pattern): ?string {
    assert(import('../context')->type()->assert($context));

    if (preg_match($pattern, $context->value)) {
        return 'validation.not-regex';
    }

    return null;
});
