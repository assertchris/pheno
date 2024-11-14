<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $notPresent = import('b/validation/1.x/rules/missing');

    // 1. Valid cases
    $assert($notPresent($context(field: 'missing', values: [])) == null);
    $assert($notPresent($context(field: 'missing', values: ['other' => 'value'])) == null);

    // 2. Invalid cases
    $assert($notPresent($context(field: 'missing', values: ['missing' => 'value'])) == 'validation.missing');
    $assert($notPresent($context(field: 'missing', values: ['missing' => 'other'])) == 'validation.missing');
});
