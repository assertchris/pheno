<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $accepted = import('b/validation/1.x/rules/accepted');

    // 1. valid cases: value is in the allowed list without conditions
    $assert($accepted($context(field: 'accepted', value: 'yes')) == null);
    $assert($accepted($context(field: 'accepted', value: 'on')) == null);
    $assert($accepted($context(field: 'accepted', value: 1)) == null);
    $assert($accepted($context(field: 'accepted', value: '1')) == null);
    $assert($accepted($context(field: 'accepted', value: true)) == null);
    $assert($accepted($context(field: 'accepted', value: 'true')) == null);

    // 2. invalid case: value is not in the allowed list
    $assert($accepted($context(field: 'accepted', value: 'no')) == 'validation.accepted');
    $assert($accepted($context(field: 'accepted', value: 0)) == 'validation.accepted');
    $assert($accepted($context(field: 'accepted', value: 'false')) == 'validation.accepted');

    // 3. conditional application: conditions are met and value is allowed
    $assert($accepted($context(field: 'accepted', value: 'yes', values: ['other' => 'active']), if: ['other' => 'active']) == null);
    $assert($accepted($context(field: 'accepted', value: true, values: ['other' => 'active']), if: ['other' => 'active']) == null);

    // 4. conditional application: conditions are met but value is not allowed
    $assert($accepted($context(field: 'accepted', value: 'no', values: ['other' => 'active']), if: ['other' => 'active']) == 'validation.accepted');

    // 5. conditional application: conditions are not met, validation is skipped
    $assert($accepted($context(field: 'accepted', value: 'no', values: ['other' => 'inactive']), if: ['other' => 'active']) == null);
    $assert($accepted($context(field: 'accepted', value: 'yes', values: ['other' => 'pending']), if: ['other' => 'active']) == null);
});
