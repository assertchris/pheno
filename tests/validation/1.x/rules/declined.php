<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $declined = import('b/validation/1.x/rules/declined');

    // 1. valid cases: all acceptable declined values
    $assert($declined($context(field: 'declined', value: 'no', values: [])) == null);
    $assert($declined($context(field: 'declined', value: 'off', values: [])) == null);
    $assert($declined($context(field: 'declined', value: 0, values: [])) == null);
    $assert($declined($context(field: 'declined', value: '0', values: [])) == null);
    $assert($declined($context(field: 'declined', value: false, values: [])) == null);
    $assert($declined($context(field: 'declined', value: 'false', values: [])) == null);

    // 2. invalid cases: values not in the allowed list
    $assert($declined($context(field: 'declined', value: 'yes', values: [])) == 'validation.declined');
    $assert($declined($context(field: 'declined', value: true, values: [])) == 'validation.declined');
    $assert($declined($context(field: 'declined', value: 1, values: [])) == 'validation.declined');
    $assert($declined($context(field: 'declined', value: '1', values: [])) == 'validation.declined');
    $assert($declined($context(field: 'declined', value: 'maybe', values: [])) == 'validation.declined');

    // 3. conditional application: checks if conditionally expected values are met
    $assert($declined($context(field: 'declined', value: 'no', values: ['other_field' => 'yes']), if: ['other_field' => 'yes']) == null);
    $assert($declined($context(field: 'declined', value: 'yes', values: ['other_field' => 'yes']), if: ['other_field' => 'yes']) == 'validation.declined');

    // 4. condition not met: does not validate if conditions are not satisfied
    $assert($declined($context(field: 'declined', value: 'no', values: ['other_field' => 'no']), if: ['other_field' => 'yes']) == null);
    $assert($declined($context(field: 'declined', value: 'yes', values: ['other_field' => 'no']), if: ['other_field' => 'yes']) == null);
});
