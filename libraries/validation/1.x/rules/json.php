<?php

return export(default: function (object $context): ?string {
    assert(import('../context')->type()->assert($context));

    if (! json_validate($context->value)) {
        return 'validation.json';
    }

    return null;
});
